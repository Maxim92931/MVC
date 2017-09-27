<?php

namespace Scraps;

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/User.php';

class UserController
{
    public function authorization()
    {
        if (isset($_SESSION['user'])) {
            header('Location: adminPanel');
        }

        if (isset($_POST['login'])) {
            $user = new User();

            $login = $_POST['login'];
            $password = $_POST['password'];

            $result = $user->authorization($login, $password);

            if ($result == '') {
                $userId = $user->getUserByLogin($login);
                $user->auth($userId);
            }

            echo $result;
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/index.php';
        }
    }

    public function reg()
    {
        if (isset($_SESSION['user'])) {
            header('Location: adminPanel');
        }

        if (isset($_POST['login'])) {
            $user = new User;

            $login = $_POST['login'];
            $password = $_POST['password'];
            $passwordRetry = $_POST['passwordRetry'];

            $result = $user->reg($login, $password, $passwordRetry);

            echo $result;
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/reg.php';
        }
    }

    public function createUser()
    {
        if (isset($_POST['login'])) {
            $user = new User;

            $login = $_POST['login'];
            $password = $_POST['password'];
            $passwordRetry = $_POST['passwordRetry'];

            $result = $user->reg($login, $password, $passwordRetry);

            echo $result;
        }
    }

    public function checkLogin()
    {
        $login = $_POST['login'];
        $user = new User;

        if ($user->isCorrectLogin($login)) {
            if ($user->isFreeLogin($login)) {
                echo '';
            } else {
                echo 'Логин уже существует';
            }
        } else {
            echo 'Некоректный логин';
        }
    }

    public function admin()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }

        $userId = $_SESSION['user'];
        $user = new User();
        $users = $user->getAllUsers('ASC');
        $files = $user->getAllFiles($userId);

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/adminPanel.php';
    }

    public function addFile()
    {
        $user = new User();
        $user->addFile($_FILES['file'], $_SESSION['user']);
    }

    public function setAvatar()
    {
        $user = new User();
        echo $user->setAvatar($_FILES['avatar'], $_POST['userId']);
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        header("Location: /");
    }
}