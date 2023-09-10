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
        $event->load('participants');
        return view('judge.score-create', compact('event'));
    }
}
