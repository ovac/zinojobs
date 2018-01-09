<?php

namespace Quarx\Modules\Companies\Controllers;

use Quarx;
use CryptoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quarx\Modules\Companies\Services\CompanyService;
use Quarx\Modules\Companies\Requests\CompanyCreateRequest;
use Quarx\Modules\Companies\Requests\CompanyUpdateRequest;

class CompaniesController extends Controller
{
    public function __construct(CompanyService $companyService)
    {
        $this->service = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = $this->service->paginated();
        return view('companies::companies.index')
            ->with('pagination', $companies->render())
            ->with('companies', $companies);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $companies = $this->service->search($request->search);
        return view('companies::companies.index')
            ->with('term', $request->search)
            ->with('pagination', $companies->render())
            ->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies::companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CompanyCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            Quarx::notification('Successfully created', 'success');
            return redirect(config('quarx.backend-route-prefix', 'quarx').'/companies/'.$result->id.'/edit');
        }

        Quarx::notification('Failed to create', 'warning');
        return redirect(config('quarx.backend-route-prefix', 'quarx').'/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->service->find($id);
        return view('companies::companies.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->service->find($id);
        return view('companies::companies.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CompanyUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
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
            return redirect(config('quarx.backend-route-prefix', 'quarx').'/companies');
        }

        Quarx::notification('Failed to delete', 'warning');
        return redirect(config('quarx.backend-route-prefix', 'quarx').'/companies');
    }
}
