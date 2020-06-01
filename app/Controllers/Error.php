<?php

namespace App\Controllers;

use \App\Core\Controller;

class Error extends Controller
{
    public function error($data)
    {
        echo $this->twig->render('error.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Erro ' . $data['errcode'],
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'errcode'               => $data['errcode']
        ]);
    }
}
