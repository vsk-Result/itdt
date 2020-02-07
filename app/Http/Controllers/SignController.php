<?php

namespace App\Http\Controllers;

use App\UseCases\SignService;
use Illuminate\Http\Request;

class SignController extends Controller
{
    private $service;

    public function __construct(SignService $service)
    {
        $this->service = $service;
    }

    public function show($company)
    {
        $companyName = $this->service->getCompanyName($company);
        return view('employees.sign.external', compact('company', 'companyName'));
    }

    public function store(Request $request)
    {
        $outputPath = $this->service->generate($request, $request->sign_company);
        return redirect($outputPath);
    }
}
