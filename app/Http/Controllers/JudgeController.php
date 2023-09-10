<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudgeController extends Controller
{
    function index()
    {
        $events = Event::whereHas('users', function ($q) {
            $q->where('user_id', Auth::id());
        })->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(25);
        return view('judge.index', compact('events'));
    }

    function eventScore($id)
    {
        $event = Event::find($id);
        return view('judge.scores.create', compact('event'));
    }

    function getScoreDataForEvent($id){
        $event = Event::find($id);

        $event->load('participants','scores');
        $data = [
            "absent" => [],
            "marked" => [],
            "unmarked" => [],
        ];
        $scores = $event->scores;

        foreach($event->participants as $p){
            $score = $scores->where('participant_id',$p->id)->first();
            if($score != null){
                if($score->absent){
                    $data["absent"][] = $p;
                }else{
                    $data["marked"][] = $p;
                }
            }else{
                $data["unmarked"][] = $p;
            }
        }

        return response()->json($data);
    }
}
