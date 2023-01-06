# Ce projet comprend deux dossiers: `api` et `front`.

## Installation

### Dans le dossier `api`
Vous trouverez un projet réalisé avec Laravel.

Pour lancer les migrations avec le seeder, ouvrez un terminal et placez-vous dans le dossier `api` :

`> cd api`

Puis installez les dépendances avec Composer :

`> composer up`

Copiez le fichier `.env.example` en `.env` et configurez la connexion à la base de données.

Générez la base de données avec la commande :

`> php artisan migrate:refresh --seed`

Pour lancer le serveur local, exécutez la commande :

`> php -S localhost:8001 -t public`

### Dans le dossier `front`
Vous trouverez un projet réalisé avec Nuxt.

Pour installer les dépendances du projet, ouvrez un terminal et placez-vous dans le dossier `front` :

`> cd front`

Copiez le fichier `.env.example` en `.env` et configurez l'URL de l'API.

- Si vous utilisez NPM

    - Installez les dépendances avec NPM :

      `> npm install`

    - Pour lancer le projet en mode développement, exécutez la commande :

      `> npm run dev`

- Si vous utilisez Yarn

    - Installez les dépendances avec Yarn :

      `> yarn`

    - Pour lancer le projet en mode développement, exécutez la commande :

      `> yarn dev`

## Lancement des tests

### Dans le dossier `api`

Pour lancer les tests, ouvrez un terminal et placez-vous dans le dossier `api` :

`> cd api`

Exécutez la commande :

`> php artisan test`

### Dans le dossier `front`

Pour lancer les tests, ouvrez un terminal et placez-vous dans le dossier `front` :

`> cd front`

- Si vous utilisez NPM

    - Exécutez la commande :

      `> npm run test`

- Si vous utilisez Yarn
  
    - Exécutez la commande :

        `> yarn test`
