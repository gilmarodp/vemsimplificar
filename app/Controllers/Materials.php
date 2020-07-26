<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Models\Resolutions;
use \App\Models\Exams;

class Materials extends Controller
{



    // =========================================================================
    // =========================================================================
    // =============================== METERIALS ===============================
    // =========================================================================
    // =========================================================================



    public function home($data)
    {
        echo $this->twig->render('user/materials/materials.html', [
            'section_site'          => ' - Materiais',
            'description'           => 'Materiais para complementar seus estudos de forma gratuita.',
            'schools'               => (new Resolutions)->getAllSchools()
        ]);
    }



    // =========================================================================
    // =========================================================================
    // =============================== EXAMS ===================================
    // =========================================================================
    // =========================================================================


    public function exams($data)
    {
        $schoolData = (new Resolutions)->getSchool($data['school']);
        echo $this->twig->render('user/materials/exams/examsYears.html', [
            'name_site'                     => '',
            'section_site'                  => 'Prova do(a) ' . $schoolData->name,
            'description'                   => 'Provas de vestibulares disponilizadas em PDF gratuitamente.',
            'school_name'                   => $schoolData,
            'exams'                         => (new Exams)->getAllExams($data['school'])
        ]);
    }



    // =========================================================================
    // =========================================================================
    // =============================== RESOLUTIONS =============================
    // =========================================================================
    // =========================================================================

    public function resolutionsYears($data)
    {
        $schoolData = (new Resolutions)->getSchool($data['school']);
        echo $this->twig->render('user/materials/resolutions/resolutionsYears.html', [
            'name_site'                     => '',
            'section_site'                  => 'Resoluções comentadas das provas do(a) ' . $schoolData->name,
            'description'                   => 'Materiais para complementar seus estudos de forma gratuita.',
            'page_exams'                    => 'materiais/',
            'school'                        => $data['school'],
            'school_name'                   => $schoolData,
            'resolution_years'              => (new Resolutions)->getAllResolutionsYears($data['school'])
        ]);
    }

    public function resolutionsDisciplines($data)
    {
        $schoolData = (new Resolutions)->getSchool($data['school']);
        echo $this->twig->render('user/materials/resolutions/resolutionsDisciplines.html', [
            'name_site'                     => '',
            'section_site'                  => 'Resoluções comentadas das provas do(a) ' . $schoolData->name,
            'description'                   => 'Materiais para complementar seus estudos de forma gratuita.',
            'page_exam_years'               => 'materiais/' . $data['school'] . '/resolucoes',
            'year'                          => $data['year'],
            'school'                        => $data['school'],
            'resolutions_disciplines'       => (new Resolutions)->getAllResolutionsDisciplines($data['school'])
        ]);
    }

    public function resolutionQuestion($data)
    {
        $disciplineId = \returnIdFromDiscipline($data);
        $resolutionQuestion = (new Resolutions)->getAllResolutionsQuestions(
            $data['year'],
            $disciplineId,
            $data['number_question']
        );

        echo $this->twig->render('user/materials/resolutions/resolutionQuestion.html', [
            'name_site'             => '',
            'section_site'          => html_entity_decode(strip_tags($resolutionQuestion->content_question)),
            'description'           => 'Materiais para complementar seus estudos de forma gratuita.',
            'page_disciplines'      => 'materiais/' . $data['school'] . '/resolucoes/' . $data['year'],
            'year'                  => $data['year'],
            'discipline'            => DISCIPLINE_NAME[$data['discipline']],
            'number_question_url'   => $data['number_question'],
            'number_questions'      => (new Resolutions)->getNumberQuestions(
                $data['year'],
                $disciplineId
            ),
            'resolution'            => $resolutionQuestion
       ]);
    }
}
