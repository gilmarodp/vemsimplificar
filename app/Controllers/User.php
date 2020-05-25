<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Support\Email;

class User extends Controller
{


    // ===================================================================================
    // ===================================================================================
    // =============================== HOME ==============================================
    // ===================================================================================
    // ===================================================================================


    public function home ($data)
    {
        echo $this->twig->render('user/home/inicio.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Início',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE'],
            'message_of_day'        => \identifyThePartOfDay(date('H'))
        ]);
    }


    // ===================================================================================
    // ===================================================================================
    // =============================== CONTACT ===========================================
    // ===================================================================================
    // ===================================================================================

    public function contact ($data)
    {
        echo $this->twig->render('user/contact/contact.html', [
            'name_site'             => SITE['NAME'],
            'section_site'          => 'Contato',
            'assets'                => DIR['ASSETS'],
            'date'                  => SITE['DATE']
        ]);
    }

    public function sendContactDiscord (){
        if (
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['email']) && !empty($_POST['email'])
        ) 
        {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo "<alert>Coloque um e-mail de verdade</alert>";
            }
            $email = new Email();
            $email->add(
                "Convite para participar do grupo do discord",
                file_get_contents(DIRPAGE . 'docs/includes/email.html'),
                $_POST['name'],
                $_POST['email']
            )->send();
            if (!$email->error()) {
                echo "<alert>Pedido enviado com sucesso! Aguarde o convite no seu e-mail</alert>";
                \header('Location: ' . URLPAGE . 'contato');
            } else {
                echo "<alert>Erro ao enviar pedido, nos envie um e-mail.</alert>";
            }
        }
    }


    // ===================================================================================
    // ===================================================================================
    // =============================== ABOUT =============================================
    // ===================================================================================
    // ===================================================================================


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