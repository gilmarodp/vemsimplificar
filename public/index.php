<?php

require __DIR__ . '/../vendor/autoload.php';

use CoffeeCode\Router\Router;

$router = new Router(substr(URLPAGE, 0, -1));

/**
 * Controllers (namespace)
 */
$router->namespace("App\Controllers");

/**
 * Controller: User.php
 * [Home]
 */
$router->group(null);
$router->get("/", "User:home");
$router->get("/home", "User:home");

/**
 * [Materiais]
 */
$router->group("materiais");
$router->get("/", "Materials:home");
$router->get("/provas", "Materials:exams");
$router->get("/resolucoes", "Materials:resolutionsYears");
$router->get("/resolucoes/{year}", "Materials:resolutionsDisciplines");
$router->get("/resolucoes/{year}/{discipline}/{number_question}", "Materials:resolutionQuestion");

/**
 * [Contato]
 */
$router->group("contato");
$router->get("/", "User:contact");

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

$router->get("/adicionar-resolucao",            "Admin:addResolution");
$router->post("/adicionar-resolucao/enviar",    "Admin:sendResolution");

$router->get("/editar-resolucao",               "Admin:editResolution");
$router->post("/editar-resolucao",              "Admin:editResolution");
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