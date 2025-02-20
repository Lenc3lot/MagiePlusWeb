<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception {

// nom de l'utilisateur de l'aplication
    const NOMUSERCONNECTE = APP_USER;
// nom de l'application
    const NOMAPPLICATION = APP_NAME;

    public function construct(string $message) {
        parent::__construct("Erreur d'application " . self::NOMAPPLICATION . "<br> user : " . self::NOMUSERCONNECTE . "<br> message :" . $message);
    }
}
