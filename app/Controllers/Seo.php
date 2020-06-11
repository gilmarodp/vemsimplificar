<?php

namespace App\Controllers;

class Seo
{
    public function robots ()
    {
        echo file_get_contents('../robots.txt');
    }

    public function sitemap ()
    {
        echo file_get_contents('../sitemap.xml');
    }
}

