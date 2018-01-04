<?php

namespace App\Http\Controllers\Employer;

use App\Company;
use App\Http\Controllers\Controller;
use App\Job;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = auth()->user()->company;

        $jobs = Job::where('company_id', $company->id)->paginate(7);

        return view('employer.jobs.index', compact('jobs'));
        // return Company::find(auth()->user()->company_id)->jobs()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = auth()->user()->company;

        return view('employer.jobs.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $job = new Job($request->all());

            $job->description = $job->description ?: 'No job description given';
            $job->company()->associate(auth()->user()->company);
            $job->user()->associate(auth()->user());

            $job->save();

            foreach ([1, 2] as $set) {
                foreach ($request->{'question_' . $set} ?: [] as $index => $_question) {
                    $question = new Question;
                    $question->question = $_question;
                    $question->answer = $request->{'answer_' . $set}[$index];
                    $question->requirement = (bool) ($set === 1);
                    $question->job()->associate($job);

                    if ($set === 2 && isset($request->type[$index])) {
                        $question->type = $request->type[$index];
                    }

                    $question->save();
                }
            }

            return redirect("/employer/jobs/{$job->id}");
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Job $job)
    {
        if ($request->ajax()) {
            $Job = $job->load('company', 'questions');
            $Job->application_count = $job->applications->count();
            return $Job;
        }

        $applications = $job->applications()->get()->where('qualified', true);

        return view('employer.jobs.applications', compact('applications', 'job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
