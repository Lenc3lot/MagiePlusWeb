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

    public function findOneBy(array $criteria): ?User
    {
        $sql = 'SELECT * FROM User WHERE ' . key($criteria) . ' = :value LIMIT 1';
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':value', current($criteria));
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new User(
                $data['Id'] ?? null,
                $data['Login'] ?? null,
                $data['Password'] ?? null,
                [] // Assuming events are not fetched here
            );
        }

        return null;
    }
}
