<?php

function startTwig()
{
	$loader = new \Twig\Loader\FilesystemLoader(DIR['VIEWS']);
	$twig = new \Twig\Environment($loader);

	$twig->addGlobal('url_base_user', URLPAGE);
	$twig->addGlobal('url_base_admin', URLPAGE . 'admin/');
	$twig->addGlobal('name_site', SITE['NAME']);
	$twig->addGlobal('name_site_logo', SITE['NAME']);
	$twig->addGlobal('assets', DIR['ASSETS']);
	$twig->addGlobal('date', SITE['DATE']);

	return $twig;
}

function convertDate($date)
{
	return date('d/m/Y', strtotime($date));
}

function identifyThePartOfDay(string $hour)
{
	if ($hour >= '6' && $hour < '12') {
		return "Bom dia caro estudante \u{1F600} \u{1F304}";
	} elseif ($hour >= '12' && $hour < '18') {
		return "Boa tarde caro estudante \u{1F600} \u{1F31E}";
	} elseif ($hour >= '18' && $hour < '24') {
		return "Boa noite caro estudante \u{1F600} \u{1F303}";
	} elseif ($hour >= '0' && $hour < '6') {
		return "Boa madrugada caro estudante \u{1F600} \u{1F303}";
	} 
}

function identifyThePartOfDayAdmin(string $hour, string $first_name, string $last_name)
{
	if ($hour >= '6' && $hour < '12') {
		return "Bom dia {$first_name} {$last_name} \u{1F600} \u{1F304}";
	} elseif ($hour >= '12' && $hour < '18') {
		return "Boa tarde {$first_name} {$last_name} \u{1F600} \u{1F31E}";
	} elseif ($hour >= '18' && $hour < '24') {
		return "Boa noite {$first_name} {$last_name} \u{1F600} \u{1F303}";
    } elseif ($hour >= '0' && $hour < '6') {
        return "Boa madrugada {$first_name} {$last_name} \u{1F600} \u{1F303}";
	} 
}

function returnIdFromDiscipline (array $data)
{
	$disciplinesData = (new \App\Models\Resolutions)->getAllResolutionsDisciplines($data['school']);
	foreach ($disciplinesData as $key => $value) {
        if ($data['discipline'] == $value['name_normal']) {
            $disciplineId = array_search($value, $disciplinesData);
        }
    }

    return (string) $disciplineId;
}
