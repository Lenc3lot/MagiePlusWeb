<?php

namespace Tools;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class MyTwig
{
    private static function getLoader(): Environment
    {
        $loader = new FilesystemLoader(PATH_VIEW);
        $environmentTwig = new Environment($loader, [
            'cache' => false,
            'debug' => true,
        ]);
        $environmentTwig->addExtension(new DebugExtension());
        return $environmentTwig;
    }

    public static function afficheVue($vue, $params): void
    {
        $twig = self::getLoader();
        $template = $twig->load($vue);
        echo $template->render($params);
    }
}
