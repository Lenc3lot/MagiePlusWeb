# MagiePlusWeb
<p align="center">
  <img src="public/assets/img/Logo_Magie_Plus.png" alt="Logo de l'application, Calendrier avec ecrit MagiePlus">
</p>


MagiePlusWeb est une application web développée en PHP et JavaScript. Elle inclut des fonctionnalités pour l'inscription des utilisateurs, la gestion des événements, et plus encore.

## Table des matières

- [Installation](#installation)
- [Utilisation](#utilisation)
- [Tests](#tests)
- [Contribuer](#contribuer)

## Installation

1. Clonez le dépôt :
    ```sh
    git clone https://github.com/Lenc3lot/MagiePlusWeb.git
    cd MagiePlusWeb
    ```

2. Installez les dépendances avec Composer :
    ```sh
    composer install
    ```

3. Configurez vos paramètres de base de données dans `Parametres.php` :
    ```php
    // Parametres.php
    const DATABASE_HOST = 'votre_hôte_db';
    const DATABASE_PORT = 'votre_port-db';
    const DATABASE_NAME = 'votre_nom_db';
    const DATABASE_USER = 'votre_utilisateur_db';
    const DATABASE_PWD = 'votre_mot_de_passe_db';
    ```

4. Ajoutez et configurez votre `.env` :
```.evn
  PROJECT_NAME = magieplusweb

  ROOT_DIR = .

  ### MARIADB ###
  MARIADB_VERSION = mariadb:11.7
  MYSQL_ROOT_PASSWORD = votre_mysql_root_password
  MYSQL_DATABASE = votre_mysql_database
  MYSQL_USER = votre_mysql_user
  MYSQL_PASSWORD = votre_mysql_password
  MARIADB_PORT_DEST = 3306
  MARIADB_PORT = 3306

  ### ADMINER ###
  ADMINER_PORT_DEST = 8080
  ADMINER_PORT = 8080
```

5. Exécutez les migrations de base de données (si nécessaire).

## Utilisation

1. Lancer Docker avec la commande :
    ```sh
    docker-compose up
    ```

2. Accédez à l'application dans votre navigateur web :
    ```
    http://localhost:8000
    ```

## Tests

1. Exécutez les tests PHPUnit :
    ```sh
    ./vendor/bin/phpunit
    ```

2. Assurez-vous que votre configuration de base de données pour les tests est correcte.

## Contribuer

1. Forkez le dépôt.
2. Créez une nouvelle branche (`git checkout -b feature-branch`).
3. Apportez vos modifications.
4. Commitez vos modifications (`git commit -am 'Ajouter une nouvelle fonctionnalité'`).
5. Poussez vers la branche (`git push origin feature-branch`).
6. Créez une nouvelle Pull Request.
