<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Models\Resolutions;
use \App\Models\Exams;

class Materials extends Controller
{
    public function home($data)
    {
        echo $this->twig->render('user/materials/materials.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Materiais',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE']
        ]);
    }

    public function exams($data)
    {
        echo $this->twig->render('user/materials/exams/examsYears.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Provas',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'exams'                 => (new Exams)->getAllExams()
        ]);
    }

    public function resolutionsYears($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionsYears.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Resoluções',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'resolution_years'           => (new Resolutions)->getAllResolutionsYears()
        ]);
    }

    public function resolutionsDisciplines($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionsDisciplines.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Resoluções',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'year'                  => $data['year'],
            'resolutions_disciplines'      => (new Resolutions)->getAllResolutionsDisciplines()
        ]);
    }

    public function resolutionQuestion($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionQuestion.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Resoluções',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE']
            # TODO Implements access to database
            # TODO Implements View to vizualization resolution of question
        ]);
    }
}