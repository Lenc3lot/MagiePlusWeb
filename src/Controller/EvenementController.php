<?php

namespace App\Controller;

use App\Entity\Evenement;
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

    public function add(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?c=security&a=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $img = $_POST['img'];
            $date = new \DateTime($_POST['date']);
            $lieu = $_POST['lieu'];
            $createurId = $_SESSION['user'];

            $userRepository = Repository::getRepository("App\Entity\User");
            $createur = $userRepository->find($createurId);

            $evenement = new Evenement($createur, $img, $titre, $description, $date, $lieu);

            $evenementRepository = Repository::getRepository("App\Entity\Evenement");
            $evenementRepository->save($evenement);

            header('Location: /index.php?c=evenement&a=index');
            exit();
        }

        $r = new ReflectionClass($this);
        $vue = str_replace('Controller', 'view', $r->getshortName()) . "/add.html.twig";
        MyTwig::afficheVue($vue, ["title" => "Add Event"]);
    }

    public function inscription(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?c=security&a=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventId = (int)$_POST['eventId'];
            $userId = (int)$_SESSION['user'];

            $evenementRepository = Repository::getRepository("App\Entity\Evenement");
            $evenementRepository->registerUserToEvent($eventId, $userId);

            header('Location: /index.php?c=evenement&a=index');
            exit();
        }

        header('Location: /index.php?c=evenement&a=index');
        exit();
    }

    public function desinscription(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?c=security&a=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventId = (int)$_POST['eventId'];
            $userId = (int)$_SESSION['user'];

            $evenementRepository = Repository::getRepository("App\Entity\Evenement");
            $evenementRepository->unregisterUserFromEvent($eventId, $userId);

            header('Location: /index.php?c=evenement&a=index');
            exit();
        }

        header('Location: /index.php?c=evenement&a=index');
        exit();
    }
}