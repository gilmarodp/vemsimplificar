<?php

require __DIR__ . '/Helper.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pasta Interna
$folderInternal = "vemsimplificar/";

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
define('PREFIX_DB', 'vemsim57_');
define('DB', [
	'TYPE' 		=> 'mysql',
	'HOST' 		=> 'localhost',
	'NAME' 		=> PREFIX_DB . 'database',
	'CHARSET'	=> 'utf8',
	'USER' 		=> 'root',
	'PASS' 		=> 'root'
]);

// Informações do site
define('SITE', [
	'NAME'		=> 'Vem Simplificar',
	'DATE'		=> date('Y')
]);

// ===================================================================================
// ===================================================================================
// =============================== DISCIPLINES =======================================
// ===================================================================================
// ===================================================================================
define('DISCIPLINE_NAME', [
	'portugues'		=> 'Português',
	'geografia'		=> 'Geografia',
	'historia'		=> 'História',
	'biologia'		=> 'Biologia',
	'fisica'		=> 'Física',
	'matematica'	=> 'Matemática',
	'quimica'		=> 'Química',
	'espanhol'		=> 'Espanhol',
	'ingles'		=> 'Inglês',
	'filosofia'		=> 'Filosofia',
	'sociologia'	=> 'Sociologia'
]);
define('DISCIPLINE_ID', [
	'portugues'		=> '1',
	'geografia'		=> '2',
	'historia'		=> '3',
	'biologia'		=> '4',
	'fisica'		=> '5',
	'matematica'	=> '6',
	'quimica'		=> '7',
	'espanhol'		=> '8',
	'ingles'		=> '9',
	'filosofia'		=> '10',
	'sociologia'	=> '11'
]);
define('ID_DISCIPLINE', [
	'1'		=> 'portugues',
	'2'		=> 'geografia',
	'3'		=> 'historia',
	'4'		=> 'biologia',
	'5'		=> 'fisica',
	'6' 	=> 'matematica',
	'7'		=> 'quimica',
	'8'		=> 'espanhol',
	'9'		=> 'ingles',
	'10'	=> 'filosofia',
	'11'	=> 'sociologia'
]);
define('ID_DISCIPLINE_NAME', [
	'1'		=> 'Português',
	'2'		=> 'Geografia',
	'3'		=> 'História',
	'4'		=> 'Biologia',
	'5'		=> 'Física',
	'6'		=> 'Matemática',
	'7'		=> 'Química',
	'8'		=> 'Espanhol',
	'9'		=> 'Inglês',
	'10'	=> 'Filosofia',
	'11'	=> 'Sociologia'
]);
define('NAME_DISCIPLINE_ID', [
	'Português'			=> '1',
	'Geografia'			=> '2',
	'História'			=> '3',
	'Biologia'			=> '4',
	'Física'			=> '5',
	'Matemática'		=> '6',
	'Química'			=> '7',
	'Espanhol'			=> '8',
	'Inglês'			=> '9',
	'Filosofia'			=> '10',
	'Sociologia'		=> '11'
]);

// ===================================================================================
// ===================================================================================
// ================================= SCHOOL ==========================================
// ===================================================================================
// ===================================================================================
define('SCHOOL', [
	'ifceforcau'			=> 'IFCE Fortaleza e Caucaia',
	'ifcefor'				=> 'IFCE Fortaleza'
]);

// ===================================================================================
// ===================================================================================
// ================================== MAIL ==========================================
// ===================================================================================
// ===================================================================================
define('MAIL', [
	'host' 				=> 'vemsimplificar.com.br ',
	'port' 				=> '465',
	'user' 				=> 'discord@vemsimplificar.com.br',
	'pass' 				=> 'GNnZ86#4RG86',
	'from_name' 		=> 'Vem Simplificar',
	'from_email' 		=> 'discord@vemsimplificar.com.br'
]);
