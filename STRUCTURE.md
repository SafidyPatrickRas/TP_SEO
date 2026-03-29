# Structure du Projet PHP - TP_SEO

## Architecture Recommandée pour un Projet PHP Structuré

```
TP_SEO/
│
├── 📁 public/                      # ⭐ Racine publique (DocumentRoot Apache)
│   ├── index.php                   # Point d'entrée principal
│   ├── 404.php                     # Page d'erreur 404
│   └── 🗂️ assets/                  # Lien symbolique vers /assets
│
├── 📁 src/                         # Code applicatif (non accessible directement)
│   ├── 📁 Core/
│   │   ├── Database.php            # Connexion PostgreSQL
│   │   ├── Router.php              # Routeur simple
│   │   └── Request.php             # Gestion des requêtes
│   │
│   ├── 📁 Controller/
│   │   ├── PostController.php       # Gestion des articles
│   │   ├── CategoryController.php   # Gestion des catégories
│   │   ├── UserController.php       # Gestion des utilisateurs
│   │   └── CommentController.php    # Gestion des commentaires
│   │
│   ├── 📁 Model/
│   │   ├── Post.php                # Modèle Post
│   │   ├── Category.php            # Modèle Catégorie
│   │   ├── User.php                # Modèle Utilisateur
│   │   ├── Tag.php                 # Modèle Tag
│   │   └── Comment.php             # Modèle Commentaire
│   │
│   └── 📁 Middleware/
│       ├── AuthMiddleware.php       # Authentification
│       └── ValidationMiddleware.php # Validation des données
│
├── 📁 views/                       # Templates HTML (PHP)
│   ├── 📁 frontend/
│   │   ├── index.php               # Page d'accueil publique
│   │   ├── post-list.php           # Liste des articles
│   │   ├── post-detail.php         # Détail d'un article
│   │   └── category.php            # Articles par catégorie
│   │
│   ├── 📁 backend/
│   │   ├── dashboard.php           # Tableau de bord admin
│   │   ├── 📁 posts/
│   │   │   ├── list.php            # Liste des articles (admin)
│   │   │   ├── edit.php            # Edition d'un article
│   │   │   └── create.php          # Création d'un article
│   │   ├── 📁 categories/
│   │   │   └── manage.php          # Gestion des catégories
│   │   └── 📁 users/
│   │       └── manage.php          # Gestion des utilisateurs
│   │
│   ├── 📁 layout/
│   │   ├── header.php              # En-tête commun
│   │   ├── footer.php              # Pied de page commun
│   │   ├── navbar.php              # Barre de navigation
│   │   └── sidebar.php             # Barre latérale (admin)
│   │
│   └── 📁 components/
│       ├── card.php                # Composant carte
│       ├── pagination.php          # Composant pagination
│       └── form-group.php          # Composant groupe de formulaire
│
├── 📁 config/                      # Configuration applicative
│   ├── database.php                # Configuration BD
│   ├── routes.php                  # Définition des routes
│   ├── constants.php               # Constantes de l'app
│   └── .env.example                # Exemple de variables d'environnement
│
├── 📁 assets/                      # Fichiers statiques
│   ├── 📁 css/
│   │   ├── style.css               # Styles principaux
│   │   └── responsive.css          # Styles responsive
│   │
│   ├── 📁 js/
│   │   ├── main.js                 # Script principal
│   │   └── api.js                  # Utilitaires API
│   │
│   └── 📁 images/
│       ├── logo.png
│       └── placeholder.png
│
├── 📁 database/                    # Scripts de gestion BD
│   └── 📁 init/
│       └── 00-init.sh              # Script d'initialisation DB
│
├── 📁 sql/                         # Scripts SQL
│   ├── base.sql                    # Schéma de la BD
│   ├── donnee.sql                  # Données de test
│   ├── recreat-base.sh             # Script de recréation BD
│   ├── donnee.sh                   # Script d'insertion données
│   ├── vide-base.sh                # Script de vidage BD
│   └── backup.sh                   # Script de sauvegarde BD
│
├── 📄 docker-compose.yml           # Configuration Docker
├── 📄 Dockerfile.php               # Image Docker PHP+Apache
├── 📄 README.md                    # Documentation générale
├── 📄 STRUCTURE.md                 # Ce fichier
├── 🚀 run.sh                       # Script de démarrage global
│
└── 📁 .git/                        # Repo Git

```

---

## Hiérarchie MVC Simplifiée

```
Requête HTTP
    ↓
public/index.php (Point d'entrée)
    ↓
src/Core/Router.php (Routeur)
    ↓
src/Core/Request.php (Analyse requête)
    ↓
src/Middleware/* (Validations)
    ↓
src/Controller/* (Logique métier)
    ↓
src/Model/* (Access données BD)
    ↓
views/* (Rendu HTML)
    ↓
Réponse HTTP + assets/ (CSS/JS/images)
```

SEO On-page géré dans `views/templates/frontend.php` via:
- `<title>` dynamique
- `<meta name="description">` dynamique

---

## Convention de Nommage

### Fichiers & Dossiers
- **Dossiers**: `lowercase_avec_underscores` (ex: `src/Core`, `views/frontend`)
- **Classes**: `PascalCase` (ex: `PostController.php`, `Database.php`)
- **Fonctions**: `camelCase` (ex: `getPostById()`, `createNewPost()`)
- **Variables**: `camelCase` (ex: `$postTitle`, `$userData`)
- **Constantes**: `UPPER_SNAKE_CASE` (ex: `DB_HOST`, `APP_DEBUG`)

### Routes Recommandées

```php
// Frontend
GET  /                           → PostController::list()
GET  /article/:slug              → PostController::show()
GET  /categorie/:name            → CategoryController::show()
GET  /tag/:name                  → TagController::show()
POST /article/:id/comment        → CommentController::create()

// Backend (Admin)
GET    /admin                    → Dashboard
GET    /admin/articles           → PostController::list()
POST   /admin/articles           → PostController::create()
GET    /admin/articles/:id/edit  → PostController::edit()
POST   /admin/articles/:id       → PostController::update()
DELETE /admin/articles/:id       → PostController::delete()

// Authentification
GET  /login                      → Auth::login()
POST /login                      → Auth::authenticate()
GET  /logout                     → Auth::logout()
```

---

## Exemple de Fichier Principal

### public/index.php
```php
<?php
// Autoloading et constantes globales
define('ROOT_PATH', dirname(__DIR__));
define('APP_DEBUG', true);

// Chargement config + classes noyau
require_once ROOT_PATH . '/config/constants.php';
require_once ROOT_PATH . '/src/Core/Database.php';
require_once ROOT_PATH . '/src/Core/Router.php';

// Initialisation
$db = new Database();
$router = new Router();

// Routes
require_once ROOT_PATH . '/config/routes.php';

// Dispatch
$router->dispatch($_GET['url'] ?? '/');
?>
```

---

## Variables d'Environnement

### .env
```
DB_HOST=postgres
DB_PORT=5432
DB_USER=postgres
DB_PASSWORD=postgres
DB_NAME=tp_seo

APP_DEBUG=true
APP_ENV=dev
APP_URL=http://localhost:8001
```

---

## Avantages de cette Structure

✅ **Séparation des responsabilités** - Code organisé et maintenable  
✅ **Sécurité** - `public/` isolé, code métier protégé  
✅ **Scalabilité** - Facile d'ajouter dossiers/fichiers  
✅ **Réutilisabilité** - Controllers, Models, Views indépendants  
✅ **Tests** - Logique métier testable indépendamment  

---

## Démarrage

```bash
./run.sh
```

Accès:
- 🌐 Frontend: `http://localhost:8001`
- 📊 Admin: `http://localhost:8001/admin`
- 🗄️  PostgreSQL: `localhost:5432`
