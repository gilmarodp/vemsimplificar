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
        echo $this->twig->render('user/home/home.html', [
            'section_site'          => ' - Plataforma de Estudos Gratuita',
            'description'           => 'Plataforma gratuita de estudos. Disponibilizamos provas, resoluções comentadas, curiosidades e dicas sobre algumas áreas do conhecimento.',
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
            'section_site'          => ' - Contato',
            'description'           => 'Venha fazer parte do nosso grupo de estudos no Discord ou entre em contato conosco, através do E-mail ou até mesmo no Instagram.'
        ]);
    }

    public function sendContactDiscord (){
        if (
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['email']) && !empty($_POST['email'])
        ) 
        {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert(Coloque um e-mail de verdade);</script>";
            }
            $email = new Email();
            $email->add(
                "Convite para participar do grupo do Discord",
                file_get_contents(DIRPAGE . 'docs/includes/email.html'),
                $_POST['name'],
                $_POST['email']
            )->send();
            if (!$email->error()) {
                \header('Location: ' . URLPAGE . 'contato');
            } else {
                echo "<script>alert(Erro ao enviar pedido, nos envie um e-mail.);</script>";
                \header('Location: ' . URLPAGE . 'contato');
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
            'section_site'          => ' - Sobre',
            'description'           => 'Descubra mais sobre nós, qual é o nosso objetivo com o projeto e quem coordena a plataforma.'
        ]);
    }
}
