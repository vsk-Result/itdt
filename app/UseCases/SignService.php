<?php

namespace App\UseCases;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;

class SignService
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

    public function getCompanyName($company)
    {
        return $this->companyNames[$company];
    }

    public function generate($data, $company)
    {
        if (!array_key_exists($company, $this->companies)) {
            return abort('404');
        }

        $domain = $this->companies[$company];
        $templateName = 'sign_' . $company . '_template.docx';

//        if ((empty($data->department) || is_null($data->department)) && $company == 'sti') {
//            $templateName = 'sign_' . $company . '_template_wd.docx';
//        }

        $outputName = 'Подпись_' . str_replace(' ', '_', $data->fullname) . '_' . $this->companyNames[$company] . '.docx';
        $outputPath = $this->outputDir . $outputName;

        putenv('TMPDIR=' . public_path('/templates'));

        $PHPWord = new PhpWord();
        $document = $PHPWord->loadTemplate(public_path('/templates/' . $templateName));

        $document->setValue('fullname', $data->fullname);
        $document->setValue('post_name', isset($data->post) ? $data->post->name : $data->postname);
//        if (!empty($data->department) || !is_null($data->department)) {
//            $templateName = 'sign_' . $company . '_template_wd.docx';
//        }
//        $document->setValue('department', $data->department);
        $document->setValue('email', method_exists($data, 'getEmail') ? $data->getEmail($domain) : $data->email);
        $document->setValue('work_phone', $data->work_phone);
        $document->setValue('phone', $data->phone_number);
        $document->saveAs(storage_path('app/public' . $outputPath));

        return '/storage' . $outputPath;
    }
}