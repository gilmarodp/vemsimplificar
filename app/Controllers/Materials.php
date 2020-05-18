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
            'name_site'                     => SITE['NAME'],
            'section_site'                  => 'Provas',
            'assets'                        => DIR['ASSETS'],
            'date'                          => SITE['DATE'],
            'exams'                         => (new Exams)->getAllExams()
        ]);
    }

    public function resolutionsYears($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionsYears.html', [
            'name_site'                     => SITE['NAME'],
            'section_site'                  => 'Resoluções',
            'assets'                        => DIR['ASSETS'],
            'date'                          => SITE['DATE'],
            'resolution_years'              => (new Resolutions)->getAllResolutionsYears()
        ]);
    }

    public function resolutionsDisciplines($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionsDisciplines.html', [
            'name_site'                     => SITE['NAME'],
            'section_site'                  => 'Resoluções',
            'assets'                        => DIR['ASSETS'],
            'date'                          => SITE['DATE'],
            'year'                          => $data['year'],
            'resolutions_disciplines'       => (new Resolutions)->getAllResolutionsDisciplines()
        ]);
    }

    public function resolutionQuestion($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionQuestion.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Resoluções',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'year'                  => $data['year'],
            'discipline'            => $data['discipline'],
            'number_question'       => $data['number_question'],
            'resolution'            => (new Resolutions)->getAllResolutionsQuestions(
                $data['year'],
                DISCIPLINE_ID[$data['discipline']],
                $data['number_question']
            )
            # TODO Implementar acesso ao banco de dados mc_resolutions_questions
            # TODO Implementar View para vizualizar resolução de questões
        ]);
    }
}