<?php

namespace App\Controller;

use ReflectionClass;
use Tools\MyTwig;

class HomeController
{
    /**
     * Affiche la page d'accueil
    */
    public function index(): void
    {
        $r = new ReflectionClass($this);
        $vue = str_replace('Controller', 'view', $r->getshortName()) . "/home.html.twig";
        MyTwig::afficheVue($vue, []);
    }
}