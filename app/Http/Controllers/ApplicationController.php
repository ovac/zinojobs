<?php

namespace App\Http\Controllers;

use App\Application;
use App\Attachment;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = auth()->user()->applications()->get()->where('qualified', true);

        return view('application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Job $job)
    {
        if ($job->applied) {
            $application = auth()->user()->applications()->where('job_id', $job->id)->first();

            return redirect("/jobs/{$job->id}/applications/{$application->id}");
        }
        return view('application.create', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Job $job, Request $request)
    {
        DB::transaction(function () use ($job, $request) {

            $application = new Application;

            $application->job()->associate($job);
            $application->user()->associate($request->user());
            $application->resume = 'noresume';

            $application->save();

            foreach ($request->attachments ?: [] as $document) {
                $attachment = new Attachment;

                $attachment->url = $document->store('attachments', 'public');
                $attachment->name = $document->getClientOriginalName();
                $attachment->application()->associate($application);
                $attachment->user()->associate($request->user());

                $attachment->save();
            }

            if (empty($request->resume)) {
                $application->resume = auth()->user()->resume
                ?: 'noresume' //REMOVE THIS IN PRODUCTION
                ;
            } else {
                $resume = new Attachment;

                $resume->url = $application->resume = $request->resume->store('attachments', 'public');
                $resume->name = 'Main Resume';

                $resume->application()->associate($application);
                $resume->user()->associate($request->user());

                $resume->save();
            }

            (function () use ($job, $application, $request) {
                $answers = [];

                foreach ($job->questions ?: [] as $question) {
                    $answer = [];
                    $answer['question_id'] = $question->id;
                    $answer['question'] = $question->question;
                    $answer['requirement'] = $question->requirement;
                    $answer['answer'] = $request->input('question_' . $question->id);

                    $answers[] = $answer;
                }

                $application->answers = json_encode($answers);
            })();

            $application->save();

            if ($application->qualified) {

                return Flash::make()
                    ->titleAs('You qualified.')
                    ->withMessage('The employer will be in touch.')
                    ->createFlash('success');
            }
        });

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job, Application $application)
    {
        return view('application.show', compact('job', 'application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
