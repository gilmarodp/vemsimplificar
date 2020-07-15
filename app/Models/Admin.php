<?php

namespace App\Models;

use \App\Core\Model;

class Admin extends Model
{

    public function isLogged(){
        if (!isset($_SESSION) || $_SESSION['isLogged'] != true) {
            \header('Location: ' . URLPAGE . 'admin');
        }
    }

    public function haveThisRole(string $role)
    {
        if (isset($_SESSION['roles']) && !empty($_SESSION['roles'])) {
            $rolesArray = \explode(' ', $_SESSION['roles']);
            if (\in_array($role, $rolesArray) || \in_array('admin', $rolesArray)) {
                return true;
            } else {
                \header('Location: ' . URLPAGE . 'admin/home');
            }
        } else {
            \header('Location: ' . URLPAGE . 'admin/home');
        } 
    }

    // ================================================================
    // ================================================================
    // =============================== LOGIN ==========================
    // ================================================================
    // ================================================================



    private function saveDataSession(string $firstName, string $lastName, string $roles)
    {
        if (isset($firstName) && !empty($firstName) && isset($lastName) && !empty($lastName)) {
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['roles'] = $roles;
        }
    }

    public function doValidateLogin(string $email, string $password)
    {
        $sql = "SELECT * FROM " . PREFIX_DB . "admins WHERE `email` = :email AND `password` = :password_login AND `active` = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':password_login', $password, \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(\PDO::FETCH_OBJ);
            $this->saveDataSession($data->first_name, $data->last_name, $data->roles);
            return true;
        } else {
            return false;
        }
    }



    // ================================================================
    // ================================================================
    // =============================== RESOLUTIONS ====================
    // ================================================================
    // ================================================================

    public function getAllSchools()
    {
        $sql = "SELECT * FROM " . PREFIX_DB . "schools";
        $stmt = $this->pdo->query($sql);
        $schools = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $schools;
    }

    public function getAllYears ()
    {
        $sql = "SELECT `year` FROM " . PREFIX_DB . "exams";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
        $years = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $years;
    }

    public function getAllDisciplines ()
    {
        $sql = "SELECT `id`, `discipline` FROM " . PREFIX_DB . "disciplines";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
        $disciplines = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $disciplines;
    }

    public function setResolutionQuestion (array $dataResolution)
    {
        $sql = "INSERT INTO " . PREFIX_DB . "resolutions_questions
        (`author`, `exam_year`, `discipline`, `number_question`, `content_question`, `resolution_question`, `school`, `date_resolution`)
        VALUES
        (:author, :exam_year, :discipline, :number_question, :content_question, :resolution_question, :name_school, :date_resolution)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':author', $dataResolution['author'], \PDO::PARAM_STR);
        $stmt->bindParam(':exam_year', $dataResolution['exam_year'], \PDO::PARAM_STR);
        $stmt->bindParam(':discipline', $dataResolution['discipline'], \PDO::PARAM_STR);
        $stmt->bindParam(':number_question', $dataResolution['number_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':content_question', $dataResolution['content_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':resolution_question', $dataResolution['resolution_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':name_school', $dataResolution['name_school'], \PDO::PARAM_STR);
        $stmt->bindParam(':date_resolution', $dataResolution['date_resolution']);

        $stmt->execute();
    }

    public function setResolutionQuestionEdited (array $dataResolution)
    {
        $sql = "UPDATE `" . PREFIX_DB . "resolutions_questions` SET
        `content_question` = :content_question, `resolution_question` = :resolution_question
        WHERE
        `author` = :author AND `exam_year` = :exam_year AND `discipline` = :discipline AND `number_question` = :number_question AND `school` = :name_school";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':content_question', $dataResolution['content_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':resolution_question', $dataResolution['resolution_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':author', $dataResolution['author'], \PDO::PARAM_STR);
        $stmt->bindParam(':exam_year', $dataResolution['exam_year'], \PDO::PARAM_STR);
        $stmt->bindParam(':discipline', $dataResolution['discipline'], \PDO::PARAM_STR);
        $stmt->bindParam(':number_question', $dataResolution['number_question'], \PDO::PARAM_STR);
        $stmt->bindParam(':name_school', $dataResolution['name_school'], \PDO::PARAM_STR);

        $stmt->execute();
    }
}
