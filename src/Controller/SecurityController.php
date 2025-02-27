<?php

namespace App\Controller;

use App\Entity\User;
use JetBrains\PhpStorm\NoReturn;
use ReflectionClass;
use Tools\MyTwig;
use Tools\Repository;

class SecurityController
{
    /**
     * Affiche la page de connexion
     */
    public function login(): void
    {
        if (isset($_SESSION['user'])) {
            header('Location: /index.php?c=evenement&a=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Assuming you have a UserRepository to fetch user data
            $userRepository = Repository::getRepository("App\Entity\User");
            $user = $userRepository->findOneBy(['login' => $login]);

            if ($user && $password === $user->getPassword()) {
                $_SESSION['user'] = $user->getId();
                $_SESSION['login'] = $user->getLogin();
                header('Location: /index.php?c=evenement&a=index');
                exit();
            } else {
                $params['error'] = 'Invalid credentials';
            }
        }

        $r = new ReflectionClass($this);
        $vue = str_replace('Controller', 'view', $r->getshortName()) . "/login.html.twig";
        MyTwig::afficheVue($vue, $params ?? ["title" => "Login"]);
    }

    public function register(): void
    {
        if (isset($_SESSION['user'])) {
            header('Location: /index.php?c=evenement&a=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $userRepository = Repository::getRepository("App\Entity\User");
            $user = new User();
            $user->setLogin($login);
            $user->setPassword($password); // Not hashing the password

            $userRepository->save($user);
            $user = $userRepository->findOneBy(['login' => $login]);

            // Initialize session
            $_SESSION['user'] = $user->getId();
            $_SESSION['login'] = $user->getLogin();
            header('Location: /index.php?c=evenement&a=index');
            exit();
        }

        $r = new ReflectionClass($this);
        $vue = str_replace('Controller', 'view', $r->getshortName()) . "/register.html.twig";
        MyTwig::afficheVue($vue, ["title" => "Register"]);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /index.php?c=evenement&a=index');
        exit();
    }
}