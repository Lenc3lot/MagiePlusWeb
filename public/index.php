<?php

use App\Exceptions\AppException;
use Tools\MyTwig;
define('DEV_MODE', true);
define('DS', DIRECTORY_SEPARATOR);
define('RACINE', new DirectoryIterator(dirname(__FILE__)) . DS . ".." . DS);
include_once(RACINE . DS . 'config/conf.php');
include_once(PATH_VENDOR . "autoload.php");
include_once(RACINE . DS . 'includes/params.php');

try {
    if ((!array_key_exists('c', $_GET)) || (!array_key_exists('a', $_GET))) {
        throw new Exception("Erreur, cette page n'existe pas");
    }
    $BaseController = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $controller = "App\\Controller\\" . $BaseController . "Controller";
    if (class_exists($controller, true)) {
        $c = new $controller();
        $params = array(array_slice($_REQUEST, 2));
        call_user_func_array(array($c, $action), $params);
    } else {
        throw new Error("Le contrôleur demandé n'existe pas");
    }
} catch (Error $ex) {
    $params['ex'] = $ex;
    $params['DEV_MODE'] = DEV_MODE;
    MyTwig::afficheVue('errors/error.html.twig', $params);
} catch (AppException $ex) {
    $params['ex'] = $ex;
    $params['DEV_MODE'] = DEV_MODE;
    MyTwig::afficheVue('errors/error.html.twig', $params);
} catch (Exception $ex) {
    $params['ex'] = $ex;
    $params['DEV_MODE'] = DEV_MODE;
    MyTwig::afficheVue('errors/error.html.twig', $params);
}
