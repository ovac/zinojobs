<?php

namespace App\Http\Controllers\Quarx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quarx\Modules\Companies\Services\CompanyService;

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
        return view('quarx-frontend::companies.all')->with('companies', $companies);
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
        return view('quarx-frontend::companies.show')->with('company', $company);
    }
}
