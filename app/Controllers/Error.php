<?php

namespace App\Controllers;

use \App\Core\Controller;

class Error extends Controller
{
    public function error($data)
    {
        echo $this->twig->render('error.html', [
            'section_site'          => ' - Erro ' . $data['errcode'],
            'errcode'               => $data['errcode']
        ]);
    }
}
