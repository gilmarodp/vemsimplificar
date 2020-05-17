<?php

namespace App\Models;

use \App\Core\Model;

class Admin extends Model
{
    private function saveDataSession(string $firstName, string $lastName)
    {
        if (isset($firstName) && !empty($firstName) && isset($lastName) && !empty($lastName)) {
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
        }
    }

    public function doValidateLogin(string $email, string $password)
    {
        $sql = "SELECT * FROM mc_admins WHERE `email` = :email AND `password` = :password_login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':password_login', $password, \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->saveDataSession($data['first_name'], $data['last_name']);
            return true;
        } else { # fazer funcão que retorna dados do Administrador e armazena nas "$_SESSION"
                 # saveDataSession
            return false;
        }
    }

    public function getAllYears ()
    {
        $sql = "SELECT `year` FROM mc_exams";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
        $years = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $years;
    }

    public function getAllDisciplines ()
    {
        $sql = "SELECT `id`, `discipline` FROM `mc_disciplines`";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
        $disciplines = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $disciplines;
    }

    public function setResolutionQuestion (array $dataResolution)
    {
        $sql = "INSERT INTO `mc_resolutions_questions`
        (`author`, `exam_year`, `discipline`, `number_question`, `content_question`, `resolution_question`, `date_resolution`)
        VALUES
        (:author, :exam_year, :discipline, :number_question, :content_question, :resolution_question, :date_resolution)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':author', $dataResolution['author'], \PDO::PARAM_STR);
        $stmt->bindParam(':exam_year', $dataResolution['exam_year'], \PDO::PARAM_STR);
        $stmt->bindParam(':discipline', $dataResolution['discipline'], \PDO::PARAM_STR);
        $stmt->bindParam(':number_question', $dataResolution['number_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':content_question', $dataResolution['content_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':resolution_question', $dataResolution['resolution_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':date_resolution', $dataResolution['date_resolution']);

        $stmt->execute();
    }
}