<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

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
            'judges' => 'required|array',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $event->users()->sync($request->judges);
        return redirect()->route('events.index');
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
        ]);
        $event = Event::find($id);
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $event->users()->sync($request->judges);
        return redirect()->route('events.index');
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
}
