<?php

namespace App\Models;

use \App\Core\Model;

class AjaxData extends Model
{

	private $year;
	private $disciplines;

	public function getDataToAjax (array $section)
	{
        if (
            isset($section['name_school']) && !empty($section['name_school']) &&
            !isset($section['exam_year']) && empty($section['exam_year']) &&
            !isset($section['discipline']) && empty($section['discipline'])
        )
        {
			$sql = "SELECT `year` FROM `" . PREFIX_DB . "resolutions_years` INNER JOIN `" . PREFIX_DB . "schools` ON `" . PREFIX_DB . "resolutions_years`.`school` = `" . PREFIX_DB . "schools`.`codename` WHERE `" . PREFIX_DB . "schools`.`codename` = :codename";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":codename", $section['name_school'], \PDO::PARAM_STR);
			$stmt->execute();
			$selectYears = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			$htmlYears = "<option value=''>Selecione o Ano</option>";
			foreach ($selectYears as $key => $value) {
				$htmlYears .= "<option value='{$value['year']}'>{$value['year']}</option>";
			}

			if ($value['year'] != null) {
				$this->year = $selectYears[0]['year'];
			}

			echo $htmlYears;
		}

        if (
            isset($section['name_school']) && !empty($section['name_school']) &&
            isset($section['exam_year']) && !empty($section['exam_year']) &&
            !isset($section['discipline']) && empty($section['discipline'])
        )
        {
			$sql = "SELECT `disciplines` FROM `" . PREFIX_DB . "schools` INNER JOIN `" . PREFIX_DB . "resolutions_years` ON `" . PREFIX_DB . "schools`.`codename` = `" . PREFIX_DB . "resolutions_years`.`school` WHERE `" . PREFIX_DB . "resolutions_years`.`year` = :exam_year";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":exam_year", $section['exam_year'], \PDO::PARAM_STR);
			$stmt->execute();
			$selectDisciplines = $stmt->fetch(\PDO::FETCH_OBJ);
			$selectDisciplines = json_decode($selectDisciplines->disciplines);

			$htmlDisciplines = "<option value=''>Selecione a Disciplina</option>";
			foreach ($selectDisciplines as $key => $value) {
				$htmlDisciplines .= "<option value='{$key}'>{$value->discipline}</option>";
			}
			echo $htmlDisciplines;
        }

        if (
            isset($section['name_school']) && !empty($section['name_school']) &&
            isset($section['exam_year']) && !empty($section['exam_year']) &&
            isset($section['discipline']) && !empty($section['discipline'])
        )
        {
            $sql = "SELECT `disciplines` FROM `" . PREFIX_DB . "schools` INNER JOIN `" . PREFIX_DB . "resolutions_years` ON `" . PREFIX_DB . "schools`.`codename` = `" . PREFIX_DB . "resolutions_years`.`school` WHERE `" . PREFIX_DB . "resolutions_years`.`year` = :exam_year";
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":exam_year", $section['exam_year'], \PDO::PARAM_STR);
			$stmt->execute();
			$selectNumberQuestions = $stmt->fetch(\PDO::FETCH_OBJ);
			$selectNumberQuestions = json_decode($selectNumberQuestions->disciplines);
            var_dump($selectNumberQuestions);
			$htmlNumberQuestions = "<option value=''>Selecione o Número da Questão</option>";
			foreach ($selectNumberQuestions as $key => $value) {
                if ($key == $section['discipline']) {
                    for ($i=1;$i<=$value->number_questions;$i++)
                        $htmlNumberQuestions .= "<option value='{$i}'>{$i}</option>";
                }
            }
			echo $htmlNumberQuestions;

        }
	}
}
