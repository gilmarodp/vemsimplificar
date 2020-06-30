<?php

require __DIR__ . '/../vendor/autoload.php';

use CoffeeCode\Router\Router;

$router = new Router(substr(URLPAGE, 0, -1));

/**
 * Controllers (namespace)
 */
$router->namespace("App\Controllers");

/**
 * SEO
 */
$router->group(null);
$router->get("/robots.txt", "Seo:robots");
$router->get("/sitemap.xml", "Seo:sitemap");

/**
 * Controller: User.php
 * [Home]
 */
$router->group(null);
$router->get("/", "User:home");

/**
 * Controller: Blog.php
 * [Blog]
 */
$router->group("blog");
$router->get("/", "Blog:home");

/**
 * [Materiais]
 */
$router->group("materiais");
$router->get("/", 																"Materials:home");
$router->get("/{school}/provas", 												"Materials:exams");
$router->get("/{school}/resolucoes", 											"Materials:resolutionsYears");
$router->get("/{school}/resolucoes/{year}", 									"Materials:resolutionsDisciplines");
$router->get("/{school}/resolucoes/{year}/{discipline}/{number_question}", 		"Materials:resolutionQuestion");

/**
 * [Contato]
 */
$router->group("contato");
$router->get("/",               "User:contact");
$router->post("/enviar-pedido", "User:sendContactDiscord");

/**
 * [Sobre]
 */
$router->group("sobre");
$router->get("/", "User:about");

/**
 * [Admins]
 */
$router->group("admin");
$router->get("/",                               "Admin:login");
$router->post("/validate",                      "Admin:validateAdminLogin");
$router->get("/home",                           "Admin:home");

$router->get("/adicionar-escola", 				"Admin:addSchool");
$router->get("/editar-escola", 					"Admin:editSchool");
$router->get("/remover-escola", 				"Admin:removeSchool");

$router->get("/adicionar-prova", 				"Admin:addExam");
$router->get("/editar-prova", 					"Admin:editExam");
$router->get("/remover-prova", 					"Admin:removeExam");

$router->get("/adicionar-gestores", 			"Admin:addExamManager");
$router->get("/editar-gestores", 				"Admin:editExamManager");
$router->get("/remover-gestores", 				"Admin:removeExamManager");


$router->post("/ajax-adicionar-resolucao",		"Admin:ajaxAddResolution");
$router->get("/adicionar-resolucao",            "Admin:addResolution");
$router->post("/adicionar-resolucao/enviar",    "Admin:sendResolution");

$router->post("/ajax-editar-resolucao",         "Admin:ajaxEditResolution");
$router->get("/editar-resolucao",               "Admin:editResolution");
$router->post("/editar-resolucao/enviar",       "Admin:sendResolutionEdited");

$router->get("/adicionar-post",                 "Admin:addPost");
$router->post("/adicionar-post",                "Admin:sendPost");

$router->get("/editar-post",                    "Admin:editPost");
$router->post("/editar-post",                   "Admin:editPost");
$router->post("/editar-post/enviar",            "Admin:sendPostEdited");

$router->get("/meus-dados",                     "Admin:viewMyData");
$router->get("/sair",                           "Admin:logout");

/**
 * [Erros]
 */
$router->group("ooops");
$router->get("/{errcode}", "Error:error");

/**
 * Inicializando
 */
$router->dispatch();

if ($router->error()) {
    $router->redirect("/ooops/{$router->error()}");
}
