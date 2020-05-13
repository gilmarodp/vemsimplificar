<?php

namespace App\Core;

class Controller
{
    protected $twig;

    function __construct ()
    {
        $this->twig = \startTwig();
    }
}