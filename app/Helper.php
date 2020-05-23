<?php

function startTwig()
{
	$loader = new \Twig\Loader\FilesystemLoader(DIR['VIEWS']);
	$twig = new \Twig\Environment($loader);

	return $twig;
}

function convertDate($date)
{
	return date('d/m/Y', strtotime($date));
}