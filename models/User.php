<?php

namespace Scraps;

require_once $_SERVER['DOCUMENT_ROOT'] . '/components/Db.php';

use PDO;
use PDOException;

class User
{
    public function authorization($login, $password)
    {
        try {
            $connection = Db::getConnection();

            $stmt = $connection->prepare("SELECT password FROM Users WHERE login = :login");
            $stmt->execute([':login'=> $login]);

            if ($pass = $stmt->fetch()[0]) {
                if (password_verify($password, $pass)) {
                    return '';
                } else {
                    return 'Неверный пароль';
                }
            } else {
                return 'Неверный логин';
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function reg($login, $password, $passwordRetry)
    {
        try {
            if (!$this->isCorrectPassword($password)) {
                return 'Некоректный пароль';
            }
            if ($password != $passwordRetry) {
                return 'Пароли не совпадают';
            }

            $connection = Db::getConnection();
            $query = "INSERT INTO Users (login, password) VALUES (:login, :password)";
            $stmt = $connection->prepare($query);
            $stmt->execute([
                ':login' => $login,
                ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

            return '';
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function getAllUsers($sort)
    {
        try {
            $connection = Db::getConnection();

            $result = $connection->query("SELECT * FROM Users ORDER BY age $sort ");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function getAllFiles($id)
    {
        try {
            $connection = Db::getConnection();

            $result = $connection->query("SELECT * FROM Files WHERE user_id = $id");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function addFile($file, $userId)
    {
        $filename = $file['name'];
        move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/files/' . $filename);

        try {
            $connection = Db::getConnection();
            $query = "INSERT INTO Files (name, user_id) VALUES (:name, :userId)";
            $stmt = $connection->prepare($query);
            $stmt->execute([
                ':name' => $filename,
                ':userId' => $userId
            ]);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function setAvatar($file, $userId)
    {
        $filename = $file['name'];
        move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/files/' . $filename);

        try {
            $connection = Db::getConnection();
            $query = "UPDATE Users SET photo = :file WHERE id = :userId";

            $stmt = $connection->prepare($query);
            $stmt->execute([
                ':file' => $filename,
                ':userId' => $userId
            ]);
            return $query;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public function getUserByLogin($login)
    {
        try {
            $connection = Db::getConnection();

            $stmt = $connection->prepare("SELECT id FROM Users WHERE login = :login");
            $stmt->execute([':login' => $login]);

            return $stmt->fetch()[0];
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }


    public function getUserById($id)
    {
        try {
            $connection = Db::getConnection();

            $stmt = $connection->prepare("SELECT * FROM Users WHERE id = :id");
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function editMyProfile($id, $name, $age, $description)
    {
        try {
            $connection = Db::getConnection();
            $query = "UPDATE Users SET name = :name, age = :age, description = :description WHERE id = :userId";

            $stmt = $connection->prepare($query);
            $stmt->execute([
                ':name' => $name,
                ':age' => $age,
                ':description' => $description,
                ':userId' => $id
            ]);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function isFreeLogin($login) : bool
    {
        try {
            $connection = Db::getConnection();

            $query = "SELECT COUNT(*) FROM Users WHERE login = :login";
            $stmt = $connection->prepare($query);
            $stmt->execute([':login' => $login]);

            if ($stmt->fetch()[0] > 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function isCorrectLogin($login) : bool
    {
        if (!preg_match("|([A-Za-z\d\-_]){4,15}|", $login)) {
            return false;
        }
        return true;
    }

    public function isCorrectPassword($password)
    {
        if (!preg_match("|([A-Za-z\d\-_]){6,15}|", $password)) {
            return false;
        }
        return true;
    }
}