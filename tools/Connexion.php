<?php
declare(strict_types=1);
namespace Tools;

use PDO;
use App\Exceptions\AppException;

class Connexion {

    private static ?PDO $connexion = null;
    private static ?Connexion $connexionInstance = null;

    private function __construct() {
        try {
            $connect_str = CNSTRING;
            $connect_user = DATABASE_USER;
            $connect_pass = DATABASE_PWD;
            $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
            self::$connexion = new PDO($connect_str, $connect_user, $connect_pass, $options);
            
        } catch (PDOException $e) {
            throw new AppException('Erreur à la connexion <br>' . $e->getMessage());
        }
    }

    public static function getConnexion() : PDO{

        if (is_null(self::$connexionInstance)) {
            self::$connexionInstance = new Connexion();
        }

        return self::$connexion;
    }
}
