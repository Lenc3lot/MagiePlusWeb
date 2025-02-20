<?php


declare(strict_types=1);

namespace App\Repository;

use App\Entity\Evenement;
use PDO;
use Tools\Repository;
use App\Entity\User;

class UserRepository extends Repository
{
    public function find(int $id): ?User {
        $sql = "SELECT * FROM User WHERE Id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();

        if ($row) {
            return new User(
                $row['Id'],
                $row['Login'],
                $row['Password']
            );
        }

        return null;
    }

}
