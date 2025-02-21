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

    public function save(Evenement $evenement): void {
        $sql = "INSERT INTO Evenement (Titre, `desc`, img, date, lieu, createur) VALUES (:titre, :desc, :img, :date, :lieu, :createur)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':titre', $evenement->getTitre(), PDO::PARAM_STR);
        $stmt->bindValue(':desc', $evenement->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':img', $evenement->getImg(), PDO::PARAM_STR);
        $stmt->bindValue(':date', $evenement->getDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->bindValue(':lieu', $evenement->getLieu(), PDO::PARAM_STR);
        $stmt->bindValue(':createur', $evenement->getCreateur()->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
}