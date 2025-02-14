<?php
declare(strict_types=1);

// Définition des constantes
define('DEV_MODE', true);
define('DS', DIRECTORY_SEPARATOR);
define('RACINE', dirname(__DIR__) . DS);

// Inclusion des fichiers nécessaires
require_once RACINE . 'config/define.php';
require_once PATH_VENDOR . 'autoload.php';
require_once RACINE . 'includes/params.php';

try {
    // Récupération et validation des paramètres
    $BaseController = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'Home';
    $action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'index';
    $controller = "App\\Controller\\" . ucfirst($BaseController) . "Controller";

    if (!class_exists($controller)) {
        throw new Error("Le contrôleur demandé n'existe pas");
    }

    $c = new $controller();

    if (!method_exists($c, $action)) {
        throw new Error("L'action demandée n'existe pas");
    }

    // Appel de l'action avec les paramètres restants
    $actionParams = array_slice($_REQUEST, 2);
    call_user_func_array([$c, $action], $actionParams);

} catch (Throwable $ex) {
    $params = [
        'ex' => $ex,
        'DEV_MODE' => DEV_MODE
    ];
    echo $params['ex'];
}
