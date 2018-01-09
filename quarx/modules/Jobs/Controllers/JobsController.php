<?php

namespace Quarx\Modules\Jobs\Controllers;

use Quarx;
use CryptoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quarx\Modules\Jobs\Services\JobService;
use Quarx\Modules\Jobs\Requests\JobCreateRequest;
use Quarx\Modules\Jobs\Requests\JobUpdateRequest;

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
        return view('jobs::jobs.index')
            ->with('pagination', $jobs->render())
            ->with('jobs', $jobs);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $jobs = $this->service->search($request->search);
        return view('jobs::jobs.index')
            ->with('term', $request->search)
            ->with('pagination', $jobs->render())
            ->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs::jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\JobCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            Quarx::notification('Successfully created', 'success');
            return redirect(config('quarx.backend-route-prefix', 'quarx').'/jobs/'.$result->id.'/edit');
        }

        Quarx::notification('Failed to create', 'warning');
        return redirect(config('quarx.backend-route-prefix', 'quarx').'/jobs');
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
        return view('jobs::jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = $this->service->find($id);
        return view('jobs::jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\JobUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobUpdateRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except(['_token', '_method']));

        if ($result) {
            Quarx::notification('Successfully updated', 'success');
            return back();
        }

        Quarx::notification('Failed to update', 'warning');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            Quarx::notification('Successfully deleted', 'success');
            return redirect(config('quarx.backend-route-prefix', 'quarx').'/jobs');
        }

        Quarx::notification('Failed to delete', 'warning');
        return redirect(config('quarx.backend-route-prefix', 'quarx').'/jobs');
    }
}
