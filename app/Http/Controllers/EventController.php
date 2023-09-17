<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Score;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('users')->paginate(25);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::where('role', 'judge')->get();
        return view('admin.events.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:events,name',
            'description' => 'nullable|string',
            'judges' => 'array',
            "event_dateTime" => "required|date_format:Y-m-d\TH:i"
        ]);

        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'event_dateTime' => $request->event_dateTime,
        ]);
        $event->users()->sync($request->judges);
        return redirect()->route('events.index')->with('success', 'Event Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $users = User::where('role', 'judge')->get();
        $event->load('users');

        return view('admin.events.edit', compact('event', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:events,name,' . $id,
            'description' => 'nullable|string',
            'judges' => 'required|array',
            "event_dateTime" => "required|date_format:Y-m-d\TH:i"
        ]);
        $event = Event::find($id);
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'event_dateTime' => $request->event_dateTime,
        ]);
        $event->users()->sync($request->judges);
        return redirect()->route('events.index')->with('success', 'Event Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::where('id', $id)->delete();
        return redirect()->back();
    }

    public function scoreCreate()
    {
        return view('admin.events.score-create');
    }

    function toggleVisibility($id)
    {
        $event = Event::find($id);
        $event->is_published = !$event->is_published;
        $event->update();

        return redirect()->back();
    }

    public function resultPublish($id)
    {

        $particapant_score = Score::where('event_id', $id)
            ->selectRaw('participant_id, sum(score) as total_score,avg(score) as avg_score')
            ->groupBy('participant_id')
            ->orderBy('total_score', 'desc')
            ->get();
        $data = [];
        $i = 0;
        $r = 1;
        $prev_score = 0;
        DB::beginTransaction();
        foreach ($particapant_score as $score) {
            if ($i == 0) {
                $rank = 1;
            } else {
                if ($score->total_score < $prev_score) {
                    $rank = ++$r;
                } else if ($score->total_score == $prev_score) {
                    $rank = $r;
                }
            }
            Participant::where('id', $score->participant_id)->update([
                'total_earn_score' => number_format($score->total_score, 2),
                'avg_score' => number_format($score->avg_score, 2),
                'rank'  => $rank,
            ]);
            $data[] = [
                'id' => $score->participant_id,
                'total_earn_score' => $score->total_score,
                'avg_score' => $score->avg_score,
                'rank'  => $rank,
            ];
            $i++;
            $prev_score = $score->total_score;
        }
        $event = Event::find($id);
        $event->result_published = true;
        $event->update();
        DB::commit();
        return redirect()->back()->with('success', 'Result Published Successfully! Now you can see the result and cannot update the score.');
    }
    public function resultUnpublish($id)
    {
        $event = Event::find($id);
        $event->result_published = false;
        $event->update();
        return redirect()->back()->with('success', 'Result Unpublished Successfully! You can now update the score.');
    }
    public function result($id)
    {
        $event = Event::find($id);
        $participants = Participant::where('event_id', $id)->where('total_earn_score','>',0)
            ->orderBy('total_earn_score', 'desc')
            ->orderBy('rank', 'asc')
            ->get();
        return view('admin.events.final-marksheet', compact('participants', 'event'));
    }
    public function judgeMarksheet(Event $event)
    {
        $judges = Score::select('user_id')
            ->where('event_id', $event->id)
            ->with('user')
            ->groupBy('user_id')
            ->get();
        $participants = Participant::where('event_id', $event->id)
            ->orderBy('rank', 'asc')
            ->get();
        return view('admin.events.judge-marksheet', compact('participants', 'event', 'judges'));
    }
    public function participantList($id)
    {
        $event = Event::find($id);
        $participants = Participant::where('event_id', $id)
            ->orderBy('id', 'asc')
            ->orderBy('serial_no', 'asc')
            ->get();
        return view('admin.events.event-participant', compact('participants', 'event'));
    }
    public function marksheet($id)
    {
        $event = Event::find($id);
        $participants = Participant::where('event_id', $id)
            ->orderBy('id', 'asc')
            ->orderBy('serial_no', 'asc')
            ->get();
        return view('admin.events.blank-marksheet', compact('participants', 'event'));
    }

    public function bulkScore(Request $request)
    {
        $user = Auth::user();
        $events = Event::when($user->role == "event-manager", function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('result_published', false)->get();

        $event = null;
        if ($request->has('event')) {
            $event = $events->where('id', $request->event)->first();
            if ($event != null) {
                $event->load('users', 'participants', 'allScores');
            }
        }
        return view('admin.bulk-score-update', compact('events', 'event'));
    }

    function bulkScoreUpdate(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $event = Event::where('id', $request->event_id)->when($user->role == "event-manager", function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->where('result_published', false)->firstOrFail();
            $event->load('participants');
            $absents = $request->has('absent') ? $request->absent : [];
            $scores = $request->has('score') ? $request->score : [];

            // Delete already existing scores to remove duplicacy as this method will repopulate all scores
            Score::where('event_id',$event->id)
            ->whereIn('participant_id',$event->participants->pluck('id'))
            ->delete();

            $scoresToEnter = [];
            foreach ($event->participants as $index => $p) {
                foreach($scores as $judge => $score){
                    if(array_key_exists($p->id, $absents)){
                        // participant is absent
                        $scoresToEnter[] = [
                            "participant_id" => $p->id,
                            "event_id" => $event->id,
                            "score" => "0",
                            "absent" => true,
                            "user_id" => $judge,
                        ];
                    }else{
                        // enter participant score
                        $participantScore = $score[$index];
                        $scoresToEnter[] = [
                            "participant_id" => $p->id,
                            "event_id" => $event->id,
                            "score" => $participantScore,
                            "absent" => false,
                            "user_id" => $judge,
                        ];
                    }
                }
            }
            Score::insert($scoresToEnter);
            DB::commit();
            return redirect()->route('events.bulk-score')->with("success","Scores updated for $event->name");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error",$e->getMessage());

        }
    }
}
