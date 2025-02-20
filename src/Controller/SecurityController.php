<?php

namespace App\Controller;

use ReflectionClass;
use Tools\MyTwig;

class SecurityController
{
    /**
     * Affiche la page de connexion
     */
    public function login(): void
    {
        $r = new ReflectionClass($this);
        $vue = str_replace('Controller', 'view', $r->getshortName()) . "/login.html.twig";
        MyTwig::afficheVue($vue, ["title" => "Login"]);
    }

    public function register(): void
    {
        $r = new ReflectionClass($this);
        $vue = str_replace('Controller', 'view', $r->getshortName()) . "/register.html.twig";
        MyTwig::afficheVue($vue, ["title" => "Register"]);
    }
}