<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Evenement;
use App\Entity\User;
use PDO;
use Tools\Repository;

class EvenementRepository extends Repository {

    public function findAll(): array {
        $sql = "SELECT e.*, p.idUser AS user_id
            FROM Evenement e
            LEFT JOIN Participer p ON e.Id = p.idEvenement";
        $stmt = $this->connexion->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();

        $userRepository = Repository::getRepository(User::class);

        $evenements = [];
        foreach ($rows as $row) {
            $evenementId = $row['Id'] ?? null;
            if ($evenementId === null) {
                continue; // Skip rows without an Id
            }
            if (!isset($evenements[$evenementId])) {
                $createur = $userRepository->find((int)$row['createur']);
                $img = $row['img'] ?? '';
                $evenements[$evenementId] = new Evenement(
                    $createur,
                    $img,
                    $row['Titre'],
                    $row['desc'],
                    new \DateTime($row['date']),
                    $row['lieu'],
                    $evenementId
                );
            }
            if ($row['user_id'] !== null) {
                $user = $userRepository->find((int)$row['user_id']);
                $evenements[$evenementId]->addUser($user);
            }
        }

        return array_values($evenements);
    }
}