<?php

namespace App\Http\Controllers\Employer;

use App\Application;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Http\Flash;
use App\Invitation;
use App\Job;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvitationController extends Controller
{

    public function __construct()
    {
        $this->middleware('message-access');
    }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job, Application $application)
    {
        $user = $request->user();

        if ($request->type == 'face2face') {

            $invitation = new Invitation($request->all());

            $invitation->note = $request->note ?: 'None';
            $invitation->time = Carbon::parse($request->date . ' ' . $request->time)->toDateTimeString();
            $invitation->user()->associate($application->user);
            $invitation->job()->associate($job);
            $invitation->application()->associate($application);
            $invitation->host_id = $user->id;

            $invitation->save();

            $messageString = "A face to face interview has been scheduled for: {$invitation->time->format('l jS \\of F Y h:i:s A')}. Interview location is set for: {$request->location}. Additional note: {$invitation->note}";

        } else {
            $messageString = "An online interview schedule has been set for {$request->date} at {$request->time}";
        }

        $message = new Message(
            ['message' => $messageString]
        );

        $message->application_id = $application->id;
        $message->user()->associate($user);

        $message->save();

        $message->load('user:id,name');

        event(new NewMessage($message));

        Flash::make()
            ->titleAs('Schedule created.')
            ->createFlash('success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        //
    }
}
