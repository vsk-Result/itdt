<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignController extends Controller
{
    private $outputDir = '/employees/sign/';
    private $companies = [
        'dt' => 'dttermo.ru',
        'sti' => 'st-ing.com',
        'pti' => 'pt-ing.ru'
    ];
    private $companyNames = [
        'dt' => 'ДТ Термо Групп',
        'sti' => 'СТИ',
        'pti' => 'ПТИ'
    ];

    public function show($company)
    {
        $companyName = $this->companyNames[$company];
        return view('employees.sign.external', compact('company', 'companyName'));
    }

    public function store(Request $request)
    {
        $company = $request->sign_company;
        if (!array_key_exists($company, $this->companies)) {
            return redirect()->back()->withInput();
        }

        $domain = $this->companies[$company];
        $templateName = 'sign_' . $company . '_template.docx';

        if (empty($request->department) || is_null($request->department) && $domain == 'sti') {
            $templateName = 'sign_' . $company . '_template_wd.docx';
        }

        $outputName = 'Подпись_' . str_replace(' ', '_', $request->name) . '_' . $this->companyNames[$company] . '.docx';
        $outputPath = $this->outputDir . $outputName;

        $PHPWord = new \PhpOffice\PhpWord\PhpWord();
        $document = $PHPWord->loadTemplate(public_path('/templates/' . $templateName));

        $document->setValue('fullname', $request->name);
        $document->setValue('post_name', $request->postname);
        if (!empty($request->department) || !is_null($request->department)) {
            $templateName = 'sign_' . $company . '_template_wd.docx';
        }
        $document->setValue('department', $request->department);
        $document->setValue('email', $request->email);
        $document->setValue('work_phone', $request->work_phone);
        $document->setValue('phone', $request->phone);
        $document->saveAs(storage_path('app/public' . $outputPath));

        return redirect('/storage' . $outputPath);
    }
}
