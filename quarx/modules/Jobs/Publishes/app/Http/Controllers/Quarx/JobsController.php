<?php

namespace App\Http\Controllers\Quarx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quarx\Modules\Jobs\Services\JobService;

class JobsController extends Controller
{
    public function __construct(JobService $jobService)
    {
        $this->service = $jobService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = $this->service->paginated();
        return view('quarx-frontend::jobs.all')->with('jobs', $jobs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = $this->service->find($id);
        return view('quarx-frontend::jobs.show')->with('job', $job);
    }
}
