<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Event;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        $classes = DB::table('classes')->get();
        return view('admin.groups.create',compact('groups','classes'));
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
            'name' => 'required|string',
            'classes' => 'array',
        ]);

        $group = Group::create([
            'name' => $request->name,
        ]);
        $group->classes()->sync($request->classes);
        return redirect()->route('groups.create')->with('success', 'Group Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $classes = Classes::all();
        $group->load('classes');
        $groups = Group::all();
        return view('admin.groups.edit', compact('group', 'classes', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {

            $this->validate($request, [
                'name' => 'required|string',
                'classes' => 'array',
            ]);

            $group->update([
                'name' => $request->name,
            ]);
            $group->classes()->sync($request->classes);
            return redirect()->route('groups.create')->with('success', 'Group Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->back()->with('success', 'Group Deleted Successfully!');
    }
}
