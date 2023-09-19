<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
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
        return view('admin.scores.create');
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
            'participant_id' => 'required|integer',
            'event_id' => 'integer',
            'score' => 'required|numeric',
            'user_id' => 'required|integer', //User=>role is judge
        ]);

        //check if score already exists
        $score_exist = Score::where('participant_id', $request->participant_id)
            ->where('event_id', $request->event_id)
            ->where('user_id', $request->user_id)
            ->exists();
        if ($score_exist) {
            return response()->json([
                'data' => '',
                'success' => true,
                'message' => 'Score Already Exists'
            ]);
        }
        $score = Score::create($request->all());
        return response()->json([
            'data' => $score,
            'success' => true,
            'message' => 'Score created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'score' => 'required|numeric', //User=>role is judge
        ]);
        $score =  Score::find($id);
        $score->score = $request->score;
        $score->absent = 0;
        $score->save();
        return response()->json([
            'data' => $score,
            'success' => true,
            'message' => 'Score Updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $score = Score::find($id);
        $score->delete();
        return response()->json([
            'success' => true,
            'message' => 'Score deleted successfully',
            'data' => $score,
        ]);
    }
    public function absentStore(Request $request)
    {
        $this->validate($request, [
            'participant_id' => 'required|integer',
            'event_id' => 'integer',
            'absent' => 'required|boolean',
            'user_id' => 'required|integer', //User=>role is judge
        ]);
        $score_exist = Score::where('participant_id', $request->participant_id)
            ->where('event_id', $request->event_id)
            ->where('user_id', $request->user_id)
            ->exists();
        if ($score_exist) {
            return response()->json([
                'data' => '',
                'success' => true,
                'message' => 'Score Already Exists'
            ]);
        }

        $score =  Score::create($request->all());
        return response()->json([
            'data' => $score,
            'success' => true,
            'message' => 'Score created successfully'
        ]);
    }
}
