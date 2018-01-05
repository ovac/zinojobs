<?php

namespace App\Http\Controllers\Employer;

use App\Application;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Http\Flash;
use App\Job;
use App\Message;
use Illuminate\Http\Request;

class ChatScheduleController extends Controller
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

        if ($request->user()->company_id = $job->company_id) {
            $message = new Message(
                ['message' => "An online interview schedule has been set for {$request->date} at {$request->time}"]
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

        return response(401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
