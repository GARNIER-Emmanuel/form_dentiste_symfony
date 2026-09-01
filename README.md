# 🦷 Form Dentiste Symfony

Application web de gestion de cabinet dentaire développée avec le framework **Symfony 6.2** et **PHP 8.1+**.

Ce projet permet aux praticiens de gérer les dossiers patients (informations personnelles, caractéristiques dentaires, bruxisme, forme de la mâchoire), de planifier les rendez-vous et d'administrer les accès utilisateurs via un système d'authentification sécurisé.

---

## 🚀 Fonctionnalités

- **Gestion des patients (CRUD complet) :**
  - Enregistrement des informations personnelles (nom, prénom, email, âge, sexe).
  - Suivi des spécificités dentaires (docteur traitant, forme de la mâchoire, bruxisme).
  - Consultation, modification et suppression des fiches clients.
- **Gestion des rendez-vous :**
  - Planification des dates de commande, prochains rendez-vous et créneaux horaires.
  - Liaison Many-to-Many entre les rendez-vous et les fiches clients.
- **Espace Formulaire interactif :**
  - Formulaire de prise en charge et de suivi patient.
- **Authentification & Sécurité :**
  - Système de connexion / déconnexion avec gestion des rôles utilisateurs (`UserInterface`, `PasswordAuthenticatedUserInterface`).
  - Protection CSRF sur les formulaires et actions de suppression.

---

## 🛠️ Stack Technique

- **Langage :** PHP >= 8.1
- **Framework backend :** Symfony 6.2.*
- **ORM & Base de données :** Doctrine ORM 2.14, Doctrine Migrations
- **Moteur de templates :** Twig 3
- **Frontend / Styling :** Bootstrap, Webpack Encore
- **Base de données supportée :** MySQL / MariaDB / PostgreSQL (Docker Compose inclus)
- **Outils de développement :** Symfony Maker Bundle, Web Profiler, PHPUnit

---

## 📁 Structure du Projet

```text
├── assets/                  # Fichiers sources JS / CSS (Webpack Encore)
├── config/                  # Configuration Symfony, routes, packages et sécurité
├── migrations/              # Migrations de base de données Doctrine
├── public/                  # Point d'entrée web (index.php) et assets compilés
├── src/
│   ├── Controller/          # Contrôleurs (InfoClient, Security, Users)
│   ├── Entity/              # Entités Doctrine (InfoClient, User, RendezVous, FormeMachoire, Sexe)
│   ├── Form/                # Types de formulaires Symfony (InfoClientType, RendezVousType, etc.)
│   ├── Repository/          # Repositories Doctrine
│   └── Security/            # Authenticateurs et configuration de sécurité
├── templates/               # Vues Twig (CRUD clients, formulaires, login, base)
├── tests/                   # Tests unitaires et fonctionnels
├── composer.json            # Dépendances PHP
├── docker-compose.yml       # Configuration Docker pour la base de données
└── webpack.config.js        # Configuration Webpack Encore
```

---

## ⚙️ Prérequis

- **PHP** >= 8.1 avec extensions requises (`ctype`, `iconv`, `pdo_mysql` ou `pdo_pgsql`)
- **Composer**
- **Symfony CLI** (recommandé)
- **Node.js** & **npm** / **yarn** (pour les assets Webpack Encore)
- **Docker** & **Docker Compose** (optionnel pour la base de données)

---

## 📦 Installation et Démarrage

### 1. Cloner le dépôt

```bash
git clone https://github.com/GARNIER-Emmanuel/form_dentiste_symfony.git
cd form_dentiste_symfony
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Configurer les variables d'environnement

Copiez le fichier d'environnement et ajustez vos identifiants de base de données :

```bash
cp .env .env.local
```

Modifiez la variable `DATABASE_URL` dans le fichier `.env.local` selon votre configuration, par exemple :

```dotenv
# Pour MySQL / MariaDB
DATABASE_URL="mysql://root:password@127.0.0.1:3306/form_dentiste?serverVersion=8.0.32&charset=utf8mb4"

# Pour PostgreSQL (ou via Docker)
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
```

### 4. Lancer la base de données (Docker - optionnel)

Si vous souhaitez utiliser le conteneur Docker fourni :

```bash
docker compose up -d
```

### 5. Créer la base de données et exécuter les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 6. Installer les assets frontend (optionnel)

```bash
npm install
npm run build
```

### 7. Lancer le serveur de développement

Avec le CLI Symfony :
```bash
symfony server:start
```

Ou avec le serveur interne PHP :
```bash
php -S 127.0.0.1:8000 -t public
```

Accédez ensuite à l'application sur : [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🌐 Routes Principales

| Route | Nom de route | Description |
| :--- | :--- | :--- |
| `/login` | `app_login` | Page de connexion |
| `/logout` | `app_logout` | Déconnexion |
| `/homepage` | `app_homep` | Page d'accueil / Formulaire interactif |
| `/infoclient` | `app_infoclient_index` | Liste de tous les dossiers clients |
| `/infoclient/new` | `app_infoclient_new` | Formulaire d'ajout d'un nouveau patient |
| `/infoclient/{id}` | `app_c_ontrolleur_info_client_crud_show` | Détails d'un patient |
| `/infoclient/{id}/edit` | `app_c_ontrolleur_info_client_crud_edit` | Modifier un patient |
| `/users/crud/controlleur` | `app_users_index` | Gestion des utilisateurs |

---

## 👤 Auteur

- **GARNIER Emmanuel** - [GARNIER-Emmanuel](https://github.com/GARNIER-Emmanuel)
