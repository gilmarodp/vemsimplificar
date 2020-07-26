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

        $this->twig->addGlobal('section_site', 'Dashboard');
        }

    // =================================================================
    // =================================================================
    // =============================== LOGIN ===========================
    // =================================================================
    // =================================================================


    public function login()
    {
        echo $this->twig->render('admin/login/login.html', [
            'section_site'              => 'Login',
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

    

    // =================================================================
    // =================================================================
    // ================================== HOME =========================
    // =================================================================
    // =================================================================


    public function home()
    {
        $this->model->isLogged();
        echo $this->twig->render('admin/dashboard/home.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']],
            'message'                   => \identifyThePartOfDayAdmin(date('H'), $_SESSION['firstName'], $_SESSION['lastName']) 
        ]);
    }

    // =================================================================
    // =================================================================
    // ============================== ADMIN ============================
    // =================================================================
    // =================================================================

    public function addSchool ()
    {
        $this->model->isLogged();
        $this->model->haveThisRole('admin');
        echo $this->twig->render('admin/dashboard/admins/addSchool.html', [
            'admin_data'    => ['firstName' => $_SESSION['firstName'],
                                'lastName' => $_SESSION['lastName'],
                                'roles' => $_SESSION['roles']],
            'action'        => 'adicionar-escola/enviar'
        ]);
    }

    public function sendSchool ()
    {
        $this->model->isLogged();
        if (
            isset($_POST['name_school']) && !empty($_POST['name_school']) &&
            isset($_POST['codename_school']) && !empty($_POST['codename_school']) &&
            isset($_POST['number_disciplines']) && !empty($_POST['number_disciplines']) &&
            isset($_POST['discipline']) && !empty($_POST['discipline']) &&
            isset($_POST['name_normal']) && !empty($_POST['name_normal']) &&
            isset($_POST['number_questions']) && !empty($_POST['number_questions'])
        ) {
            $dataSchool = [
                'name_school'       => $_POST['name_school'],
                'codename_school'   => $_POST['codename_school'],
                'number_disciplines'=> $_POST['number_disciplines'],
                'discipline'        => $_POST['discipline'],
                'name_normal'       => $_POST['name_normal'],
                'number_questions'  => $_POST['number_questions']
            ];
        } else {\header('Location: ' . URLPAGE . 'admin/home');}

        $this->model->setSchool($dataSchool);
        \header('Location: ' . URLPAGE . 'admin/adicionar-escola');

    }

    public function editSchool ()
    {
        $this->model->isLogged();
        $this->model->haveThisRole('admin');
        echo $this->twig->render('admin/dashboard/admins/editSchool.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']],
        ]);
    }

    public function removeSchool ()
    {
        $this->model->isLogged();
        $this->model->haveThisRole('admin');
        echo $this->twig->render('admin/dashboard/admins/removeSchool.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']],
        ]);
    }


    public function addExam ()
    {
        $this->model->isLogged();
        $this->model->haveThisRole('admin');
        echo $this->twig->render('admin/dashboard/admins/addExam.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']],
            'action'        => 'adicionar-prova/enviar'
        ]);
    }

    public function sendExam ()
    {
        $this->model->isLogged();
        if (
            isset($_POST['codename_school']) && !empty($_POST['codename_school']) &&
            isset($_POST['exam_year']) && !empty($_POST['exam_year']) &&
            isset($_POST['link']) && !empty($_POST['link'])
        )
        {
            $dataExam = [
                'codename_school'   => $_POST['codename_school'],
                'exam_year'         => $_POST['exam_year'],
                'link'              => $_POST['link']
            ];
        } else {\header('Location: ' . URLPAGE . 'admin/home');}
        $this->model->setExam($dataExam);
        \header('Location: ' . URLPAGE . 'admin/adicionar-escola');
    }

    public function editExam ()
    {}

    public function removeExam ()
    {}


    public function addExamManager ()
    {}

    public function editExamManager ()
    {}

    public function removeExamManager ()
    {}



    // =================================================================
    // =================================================================
    // =============================== RESOLUTIONS =====================
    // =================================================================
    // =================================================================

    public function ajaxAddResolution ()
    {
        $this->model->isLogged();
        if (isset($_POST) && !empty($_POST))
            echo (new \App\Models\AjaxData)->getToAddResolution($_POST);
    }

    public function addResolution ()
    {
        $this->model->isLogged();
        $this->model->haveThisRole('reso');
        echo $this->twig->render('admin/dashboard/resolution/addResolution.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']],
            'action'                => 'adicionar-resolucao/enviar',
            'schools'               => $this->model->getAllSchools()
        ]);
    }

    public function sendResolution()
    {
        $this->model->isLogged();
        if (
            isset($_POST['author']) && !empty($_POST['author']) &&
            isset($_POST['name_school']) && !empty($_POST['name_school']) &&
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
                'name_school'           => $_POST['name_school'],
                'date_resolution'       => \date('Y-m-d')
            ];
        } else {\header('Location: ' . URLPAGE . 'admin/home');}

        $this->model->setResolutionQuestion($dataResolution);
        \header('Location: ' . URLPAGE . 'admin/adicionar-resolucao');
    }

    public function ajaxEditResolution ()
    {
        $this->model->isLogged();
        if (isset($_POST) && !empty($_POST))
           echo (new \App\Models\AjaxData)->getToEditResolution($_POST);
    }

    public function editResolution ()
    {
        $this->model->isLogged();
        $this->model->haveThisRole('reso');
        echo $this->twig->render('admin/dashboard/resolution/editResolution.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']],
            'action'                => 'editar-resolucao/enviar',
            'schools'               => $this->model->getAllSchools()
        ]);
    }

    public function sendResolutionEdited()
    {
        $this->model->isLogged();
        if (
            isset($_POST['author']) && !empty($_POST['author']) &&
            isset($_POST['name_school']) && !empty($_POST['name_school']) &&
            isset($_POST['exam_year']) && !empty($_POST['exam_year']) &&
            isset($_POST['discipline']) && !empty($_POST['discipline']) &&
            isset($_POST['number_question']) && !empty($_POST['number_question']) &&
            isset($_POST['content_question']) && !empty($_POST['content_question']) &&
            isset($_POST['resolution_question']) && !empty($_POST['resolution_question'])
        ) {
            $dataResolution = [
                'author'                => $_POST['author'],
                'name_school'           => $_POST['name_school'],
                'exam_year'             => $_POST['exam_year'],
                'discipline'            => $_POST['discipline'],
                'number_question'       => $_POST['number_question'],
                'content_question'      => $_POST['content_question'],
                'resolution_question'   => $_POST['resolution_question'],
            ];
        } else {\header('Location: ' . URLPAGE . 'admin/home');}

        $this->model->setResolutionQuestionEdited($dataResolution);
        \header('Location: ' . URLPAGE . 'admin/editar-resolucao');
    }




    // =================================================================
    // =================================================================
    // ================================ BLOG ===========================
    // =================================================================
    // =================================================================


    public function addPost(){
        $this->model->isLogged();
        $this->model->haveThisRole('blog');
        echo $this->twig->render('admin/dashboard/blog/addPost.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']]
        ]);
    }

    public function editPost(){
        $this->model->isLogged();
        $this->model->haveThisRole('blog');
        echo $this->twig->render('admin/dashboard/blog/editPost.html', [
            'admin_data' => ['firstName' => $_SESSION['firstName'],
                             'lastName' => $_SESSION['lastName'],
                             'roles' => $_SESSION['roles']]
        ]);
    }




    // =================================================================
    // =================================================================
    // =============================== OPTIONS =========================
    // =================================================================
    // =================================================================   
    
    public function viewMyData(){
        $this->model->isLogged();
        echo $this->twig->render('admin/dashboard/myData/viewMyData.html', []);
    }

    public function logout()
    {
        $_SESSION['isLogged'] = false;
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        unset($_SESSION['roles']);
        \header('Location: ' . URLPAGE . 'admin');
    }
}
