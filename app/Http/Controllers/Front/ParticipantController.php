<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\ParticipantStoreRequest;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Score;
use App\Traits\ResponseTrait;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Classes;
use App\Models\Group;
use App\Models\Setting;
use Exception;

class ParticipantController extends Controller
{
    use ResponseTrait, StoreImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $participants = Participant::latest()->paginate(20);

        // $startNumber = ($participants->currentPage() - 1) * $participants->perPage() + 1;
        // return view('admin.participants.index', compact('participants', 'startNumber'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resitraion = Setting::where('key', 'registration')->first();
        abort_if($resitraion == null, 404);
        $status = null;
        if ($resitraion->value == "open") {
            $events = Event::where('result_published', 0)->get();
            $groups = Group::all();
            $non_optional_categories = Category::where('is_optional', 'Not Optional')->latest()->get();
            $optional_categories = Category::where('is_optional', 'Optional')
                ->with('unpublishedEvents')
                ->get();
            // dd($optional_categories->toArray());
            $classes = Classes::all();
            return view('front.participant.create', compact('events', 'groups', 'classes', 'status', 'optional_categories', 'non_optional_categories'));
        } else {
            $status = "Registration Closed Now . Please Contact With Admin";
            return view('front.participant.create', compact('status'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipantStoreRequest $request)
    {
        $non_optional_event = collect($request->event_non_optional);
        $optional_event = collect($request->event_optional);

         $filtered_non_optional_event = $non_optional_event->filter(function ($value) {
            return $value !== null;
        });
        $filtered_optional_event = $optional_event->filter(function ($value) {
            return $value !== null;
        });
        $merged_events = $filtered_non_optional_event->merge($filtered_optional_event);

        $total_non_optional_event = (int) count($filtered_non_optional_event);

        $total_optional_event = (int) count($filtered_optional_event);

        $rules = [];
        if (($total_non_optional_event+ $total_optional_event) <= 0) {
            $rules['event'] = 'required';
            $messages = [
                'event.required' => 'আপনি একটা ইভেন্ট ও নির্বাচন করেননি',
            ];
            $request->validate($rules, $messages);
        }

        if ($total_non_optional_event > 3) {
            $rules['event'] = 'required';
            $messages = [
                'event.required' => 'অতিরক্ত ইভেন্ট ছাড়া ৩ এর অধিক ইভেন্ট নির্বাচন করা যাবে না',
            ];
            $request->validate($rules, $messages);
        }

        $participant_info = $request->except('event_non_optional', 'event_optional', 'event', 'group_id');

        foreach($merged_events as $event){
            $participant_info['event_id'] = $event;
            $participant_info['serial_no'] = Participant::where('event_id', $event)->count() + 1;
            $participant = Participant::create($participant_info);
        }
        // $serial = Participant::where('event_id', $request->event_id)->count();
        // $request->merge(['serial_no' => $serial + 1]);
        // $participant = Participant::create($request->all());


        $msg = 'Your Registration Successfully Completed.';

        // $msg = 'Your Registration Successfully Completed in ' . $participant->event->name . ' Your Serial No is ' . ($serial + 1);

        //image upload

        $slug = $request->input('name_en');

        if ($request->hasFile('participant_photo')) {
            $imageName = $this->verifyAndStoreImage($request, 'participant_photo', $slug . 'photo', 'participants');
            $participant->participantPhotos()->create(['url' => $imageName, 'type' => 'participant_photo']);
        }
        if ($request->hasFile('bcirtificate_photo')) {
            $imageName = $this->verifyAndStoreImage($request, 'bcirtificate_photo', $slug . 'dob', 'participants/bcirtificates');
            $participant->bcertificatePhotos()->create(['url' => 'bcirtificates/' . $imageName, 'type' => 'bcertificate_photo']);
        }
        if ($request->hasFile('auth_photo')) {
            $imageName = $this->verifyAndStoreImage($request, 'auth_photo', $slug . 'auth_photo', 'participants/authorizations');
            $participant->authorizationPhotos()->create(['url' => 'authorizations/' . $imageName, 'type' => 'auth_photo']);
        }

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        $participant->load('event');
        return view('admin.participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            "name_en" => "nullable|string",
            "name_bn" => "nullable|string",
            "email" => "nullable|email",
            "phone" => "nullable|numeric",
            "class" => "nullable",
            "dob" => "nullable|string",
            "inst_name" => "nullable|string",
            "inst_address" => "nullable|string",
            'serial_no' => 'nullable',
        ]);
        $participant->update($validated);

        return redirect()->route('participants.index')->with('success', "Participant information updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
    }

    public function getEvent(Request $request)
    {

        try {
            $events = Event::where('group_id', $request->group_id)
                ->where('result_published', 0)
                ->get();
            $group = Group::where('id', $request->group_id)->with('classes')->first();
            $non_optional_categories = Category::where('is_optional', 'Not Optional')
                ->latest()
                ->with(['unpublishedEvents' => function ($query) use ($request) {
                    $query->where('group_id', $request->group_id);
                }])
                ->get();
            $data = [
                'events' => $events,
                'classes' => $group->classes,
                'non_optional_categories' => $non_optional_categories,
            ];
            return $this->responseSuccess($data, 'Data Fetched Successfully');
        } catch (Exception $e) {
            return $this->responseError($e->getMessage(), 'Something Went Wrong');
        }
    }
}
