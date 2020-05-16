<?php

namespace App\Controllers;

use \App\Core\Controller;

class Admin extends Controller
{
    public function __construct () {
        parent::__construct();
        \session_start();
    }
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
        
    public function home()
    {
        if (!isset($_SESSION) || $_SESSION['isLogged'] !== true) {
            \header('Location: ' . URLPAGE . 'admin');
        }

        echo $this->twig->render('admin/dashboard/home.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function addResolution(){
        echo $this->twig->render('admin/dashboard/addResolution.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function editResolution(){
        echo $this->twig->render('admin/dashboard/editResolution.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function addPost(){
        echo $this->twig->render('admin/dashboard/addPost.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function editPost(){
        echo $this->twig->render('admin/dashboard/editPost.html', [
            'name_site'                 => SITE['NAME'],
            'section_site'              => 'Dashboard',
            'assets'                    => DIR['ASSETS']
        ]);
    }

    public function viewMyData(){
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