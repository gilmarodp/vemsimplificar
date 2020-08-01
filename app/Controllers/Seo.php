<?php

namespace App\Controllers;

class Seo
{
    public function requests ($data)
    {
        $types = ['txt', 'xml', 'css', 'js'];
        if (file_exists("../{$data['requests']}")) {
            $pathfile = "../{$data['requests']}";
            $pathinfo = pathinfo($pathfile);
            if (in_array($pathinfo['extension'], $types)) {
                $this->showContent($pathfile);
            }
        } else {
            \header('Location: ' . URLPAGE . 'ooops/404');
        }
    }

    public function showContent ($pathfile)
    {
        include_once($pathfile);
    }
}

