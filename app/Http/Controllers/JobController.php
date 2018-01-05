<?php

namespace App\Http\Controllers;

use App\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('job-access')->except(['index', 'store', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs =

        Job::

            where(function ($query)
             use ($request) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhereHas('company',
                        function ($query) use ($request) {
                            $query->where('name', 'LIKE', "%{$request->search}%");
                        });
            })->

            where(function ($query)
             use ($request) {
                $query->where('location', 'LIKE', "%{$request->location}%")
                    ->orWhereHas('company', function ($query) use ($request) {
                        $query->where('address', 'LIKE', "%{$request->location}%");
                    });
            })->

            whereDate('closing', '>', Carbon::now()->toDateTimeString())->

            paginate(6);

        return view('jobs.index', compact('jobs'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Job $job)
    {
        if ($request->ajax()) {
            return $job->load('company');
        }

        return view('jobs.job', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
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
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
