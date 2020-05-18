<?php

require __DIR__ . '/Helper.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pasta Interna
$folderInternal = "vem_simplificar/";

// Endereços importantes
define('URLPAGE', "http://{$_SERVER['HTTP_HOST']}/{$folderInternal}");
if (substr($_SERVER['DOCUMENT_ROOT'], -1) == '/') {
	define('DIRPAGE', "{$_SERVER['DOCUMENT_ROOT']}{$folderInternal}");    
} else {
	define('DIRPAGE', "{$_SERVER['DOCUMENT_ROOT']}/{$folderInternal}");
}

// Diretórios importantes
define('DIR', [
	'CONTROLLERS' 	=> __DIR__ . '/Controllers',
	'MODELS' 		=> __DIR__ . '/Models',
	'VIEWS' 		=> __DIR__ . '/Views',
	'ASSETS'		=> URLPAGE . 'public/assets/'
]);

// Configurações Banco de Dados
define('DB', [
	'TYPE' 		=> 'mysql',
	'HOST' 		=> 'localhost',
	'NAME' 		=> 'mc_database',
	'USER' 		=> 'root',
	'PASS' 		=> 'root'
]);

// Informações do site
define('SITE', [
	'NAME'		=> 'Vem Simplificar',
	'DATE'		=> date('Y')
]);

define('DISCIPLINE_NAME', [
	'portugues'		=> 'Português',
	'geografia'		=> 'Geografia',
	'historia'		=> 'História',
	'biologia'		=> 'Biologia',
	'fisica'		=> 'Física',
	'matematica'	=> 'Matemática',
	'quimica'		=> 'Química'
]);

define('DISCIPLINE_ID', [
	'portugues'		=> '1',
	'geografia'		=> '2',
	'historia'		=> '3',
	'biologia'		=> '4',
	'fisica'		=> '5',
	'matematica'	=> '6',
	'quimica'		=> '7'
]);