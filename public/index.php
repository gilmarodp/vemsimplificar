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
$router->get("/{requests}", "Seo:requests");

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
$router->post("/adicionar-escola/enviar", 		"Admin:sendSchool");

$router->get("/adicionar-prova", 				"Admin:addExam");
$router->post("/adicionar-prova/enviar", 		"Admin:sendExam");

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
