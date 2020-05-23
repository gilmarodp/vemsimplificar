<?php

function startTwig()
{
	$loader = new \Twig\Loader\FilesystemLoader(DIR['VIEWS']);
	$twig = new \Twig\Environment($loader);

	return $twig;
}

function datetimeToDateConvert($date)
{
	$date = explode(' ', $date)[0];

	return date('d/m/Y', strtotime($date));
}