<?php

namespace App\Controllers;

use \App\Core\Controller;

class User extends Controller
{
    public function home ($data)
    {
        echo $this->twig->render('user/home/home.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Início',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE']
        ]);
    }

    public function contact ($data)
    {
        echo $this->twig->render('user/contact/contact.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Contato',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE']
        ]);
    }

    public function about ($data)
    {
        echo $this->twig->render('user/about/about.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Sobre',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE']
        ]);
    }
}