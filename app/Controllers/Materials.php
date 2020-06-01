<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Models\Resolutions;
use \App\Models\Exams;

class Materials extends Controller
{



    // ===================================================================================
    // ===================================================================================
    // =============================== METERIALS =========================================
    // ===================================================================================
    // ===================================================================================



    public function home($data)
    {
        echo $this->twig->render('user/materials/materials.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Materiais',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'schools'               => (new Resolutions)->getAllSchools()
        ]);
    }



    // ===================================================================================
    // ===================================================================================
    // =============================== EXAMS =============================================
    // ===================================================================================
    // ===================================================================================



    public function exams($data)
    {
        echo $this->twig->render('user/materials/exams/examsYears.html', [
            'name_site'                     => SITE['NAME'],
            'section_site'                  => 'Provas',
            'assets'                        => DIR['ASSETS'],
            'date'                          => SITE['DATE'],
            'school_name'                   => (new Resolutions)->getSchool($data['school']),
            'exams'                         => (new Exams)->getAllExams($data['school'])
        ]);
    }



    // =========================================================================
    // =========================================================================
    // =============================== RESOLUTIONS =============================    // =========================================================================
    // =========================================================================

    public function resolutionsYears($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionsYears.html', [
            'name_site'                     => SITE['NAME'],
            'section_site'                  => 'Resoluções',
            'assets'                        => DIR['ASSETS'],
            'date'                          => SITE['DATE'],
            'school'                        => $data['school'],
            'school_name'                   => (new Resolutions)->getSchool($data['school']),
            'resolution_years'              => (new Resolutions)->getAllResolutionsYears($data['school'])
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
            'school'                        => $data['school'],
            'resolutions_disciplines'       => (new Resolutions)->getAllResolutionsDisciplines($data['school'])
        ]);
    }

    public function resolutionQuestion($data)
    {
        echo $this->twig->render('user/materials/resolutions/resolutionQuestion.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Resoluções',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'page_ago'              => 'materiais/' . $data['school'] . '/resolucoes/' . $data['year'],
            'year'                  => $data['year'],
            'discipline'            => DISCIPLINE_NAME[$data['discipline']],
            'number_question_url'       => $data['number_question'],
            'number_questions'      => (new Resolutions)->getNumberQuestions(
                $data['year'],
                DISCIPLINE_ID[$data['discipline']]
            ),
            'resolution'            => (new Resolutions)->getAllResolutionsQuestions(
                $data['year'],
                DISCIPLINE_ID[$data['discipline']],
                $data['number_question']
            )
       ]);
    }
}
