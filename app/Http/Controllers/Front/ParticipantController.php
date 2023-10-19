<?php

namespace App\Http\Controllers\Front;

use App\Exports\SampleParticipantExport;
use App\Imports\ParticipantsImport;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Score;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
class ParticipantController extends Controller
{
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
        $events = Event::all();
        return view('front.participant.create',compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        return redirect()->route('participants.index')->with('success', 'Participants Imported successfully.');
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

        return redirect()->route('participants.index')->with('success',"Participant information updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        Score::where('participant_id',$participant->id)->delete();
        $participant->delete();
        return redirect()->route('participants.index')->with('success',"Participant deleted.");
    }

    public function importview()
    {
        $participants = Participant::all();
        return view('admin.participants.import', compact('participants'));
    }
    public function excelSample(){
        return Excel::download(new SampleParticipantExport(), 'participant_sample.xlsx');
    }
}
