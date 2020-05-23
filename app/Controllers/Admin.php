<?php

namespace App\Controllers;

use \App\Core\Controller;

class Admin extends Controller
{

    private $model;

    public function __construct () {
        parent::__construct();
        \session_start();
        $this->model = new \App\Models\Admin;
    }

    private function isLogged(){
        if (!isset($_SESSION) || $_SESSION['isLogged'] !== true) {
            \header('Location: ' . URLPAGE . 'admin');
        }
    }


    // ===================================================================================
    // ===================================================================================
    // =============================== LOGIN =============================================
    // ===================================================================================
    // ===================================================================================


    public function login()
    {
        echo $this->twig->render('admin/login/login.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Login',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function validateAdminLogin()
    {
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
            if ((new \App\Models\Admin)->doValidateLogin($_POST['email'], sha1(md5($_POST['password'])))) {
                $_SESSION['isLogged'] = true;
                \header('Location: ' . URLPAGE . 'admin/home');
            
            } else {
            
                $_SESSION['isLogged'] = false;
                \header('Location: ' . URLPAGE . 'admin');
            
            }
        } else {
            
            $_SESSION['isLogged'] = false;
            \header('Location: ' . URLPAGE . 'admin');
        }
    }

    

    // ===================================================================================
    // ===================================================================================
    // =============================== DASHBOARD =========================================
    // ===================================================================================
    // ===================================================================================




    public function home()
    {
        $this->isLogged();
        echo $this->twig->render('admin/dashboard/home.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }


    // ===================================================================================
    // ===================================================================================
    // =============================== RESOLUTIONS =======================================
    // ===================================================================================
    // ===================================================================================

    public function addResolution(){
        $this->isLogged();
        echo $this->twig->render('admin/dashboard/addResolution.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS'],
            'admin'                     => ['firstName' => $_SESSION['firstName'],
                                            'lastName' => $_SESSION['lastName']],
            'years'                     => $this->model->getAllYears(),
            'disciplines'               => $this->model->getAllDisciplines()
        ]);
    }

    public function sendResolution()
    {
        $this->isLogged();
        if (
            isset($_POST['author']) && !empty($_POST['author']) &&
            isset($_POST['exam_year']) && !empty($_POST['exam_year']) &&
            isset($_POST['discipline']) && !empty($_POST['discipline']) &&
            isset($_POST['number_question']) && !empty($_POST['number_question']) &&
            isset($_POST['content_question']) && !empty($_POST['content_question']) &&
            isset($_POST['resolution_question']) && !empty($_POST['resolution_question'])
        ) {
            $dataResolution = [
                'author'                => $_POST['author'],
                'exam_year'             => $_POST['exam_year'],
                'discipline'            => $_POST['discipline'],
                'number_question'       => $_POST['number_question'],
                'content_question'      => $_POST['content_question'],
                'resolution_question'   => $_POST['resolution_question'],
                'date_resolution'       => \date('Y-m-d')
            ];
        } else {\header('Location: ' . URLPAGE . 'admin/home');}

        $this->model->setResolutionQuestion($dataResolution);
        \header('Location: ' . URLPAGE . 'admin/adicionar-resolucao');
    }

    public function editResolution(){
        $this->isLogged();
        if (
            isset($_POST['author']) && !empty($_POST['author']) &&
            isset($_POST['exam_year']) && !empty($_POST['exam_year']) &&
            isset($_POST['discipline']) && !empty($_POST['discipline']) &&
            isset($_POST['number_question']) && !empty($_POST['number_question'])
        ) {
            $dataResolution = [
                'author'                => $_POST['author'],
                'exam_year'             => $_POST['exam_year'],
                'discipline'            => $_POST['discipline'],
                'number_question'       => $_POST['number_question']
            ];
            echo $this->twig->render('admin/dashboard/editResolution.html', [
                'name_site'                 => SITE['NAME'],
                'section_site'              => 'Dashboard',
                'assets'                    => DIR['ASSETS'],
                'action'                    => 'editar-resolucao/enviar',
                'admin'                     => $_POST['author'],
                'exam_year'                 => $_POST['exam_year'],
                'discipline'                => ID_DISCIPLINE_NAME[$_POST['discipline']],
                'number_question'           => $_POST['number_question'],
                'resolution'                => $this->model->getResolutionQuestion($dataResolution)
            ]);
        } else {
            echo $this->twig->render('admin/dashboard/editResolution.html', [
                'name_site'                 => SITE['NAME'],
                'section_site'              => 'Dashboard',
                'assets'                    => DIR['ASSETS'],
                'action'                    => 'editar-resolucao',
                'admin'                     => ['firstName' => $_SESSION['firstName'],
                                                'lastName' => $_SESSION['lastName']],
                'years'                     => $this->model->getAllYears(),
                'disciplines'               => $this->model->getAllDisciplines()
            ]);
        }
    }

    public function sendResolutionEdited()
    {
        $this->isLogged();
        if (
            isset($_POST['author']) && !empty($_POST['author']) &&
            isset($_POST['exam_year']) && !empty($_POST['exam_year']) &&
            isset($_POST['discipline']) && !empty($_POST['discipline']) &&
            isset($_POST['number_question']) && !empty($_POST['number_question']) &&
            isset($_POST['content_question']) && !empty($_POST['content_question']) &&
            isset($_POST['resolution_question']) && !empty($_POST['resolution_question'])
        ) {
            $dataResolution = [
                'author'                => $_POST['author'],
                'exam_year'             => $_POST['exam_year'],
                'discipline'            => NAME_DISCIPLINE_ID[$_POST['discipline']],
                'number_question'       => $_POST['number_question'],
                'content_question'      => $_POST['content_question'],
                'resolution_question'   => $_POST['resolution_question'],
                'date_resolution'       => \date('Y-m-d')
            ];
        } else {\header('Location: ' . URLPAGE . 'admin/home');}

        $this->model->setResolutionQuestionEdited($dataResolution);
        \header('Location: ' . URLPAGE . 'admin/editar-resolucao');
    }




    // ===================================================================================
    // ===================================================================================
    // =============================== POSTS =============================================
    // ===================================================================================
    // ===================================================================================


    public function addPost(){
        $this->isLogged();
        echo $this->twig->render('admin/dashboard/addPost.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function editPost(){
        $this->isLogged();
        echo $this->twig->render('admin/dashboard/editPost.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function viewMyData(){
        $this->isLogged();
        echo $this->twig->render('admin/dashboard/viewMyData.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function logout()
    {
        $_SESSION['isLogged'] = false;
        \header('Location: ' . URLPAGE . 'admin');
    }
}