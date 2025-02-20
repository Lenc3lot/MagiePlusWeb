<?php

namespace App\Controller;

use ReflectionClass;
use Tools\MyTwig;
use Tools\Repository;

class EvenementController
{

    public function index(): void
    {
        $params['title'] = "Evenement";
        $evenementRepository = Repository::getRepository("App\Entity\Evenement");
        $params['evenements'] = $evenementRepository->findAll();

        $r = new ReflectionClass($this);
        $vue = str_replace('Controller', 'view', $r->getshortName()) . "/evenement.html.twig";
        MyTwig::afficheVue($vue, $params);
    }
}