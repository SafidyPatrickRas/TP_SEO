# TP_SEO - Projet Site d'Informations sur la Guerre en Iran

## 🎯 Contexte du Projet

Ce projet consiste à développer une plateforme complète d'informations sur la situation en Iran, incluant architecture base de données, interfaces front-end et back-end en PHP pur, ainsi que l'optimisation SEO.

**Stack technique** : PHP pur (brute) + PostgreSQL + Apache + Docker

---

## 🎯 Objectifs du Projet

### 1. 📰 Créer un site d'informations sur la guerre en Iran
Développer une plateforme de partage d'informations, d'actualités et d'analyses concernant la situation géopolitique en Iran.

### 2. 🗄️ Créer la base de données
Concevoir et mettre en place une base de données PostgreSQL pour stocker :
- Les utilisateurs et leurs rôles
- Les contenus (posts/articles)
- Les catégories et tags
- Les commentaires
- Les relations entre entités

### 3. 🌐 Créer le site FrontOffice
Développer l'interface publique permettant aux visiteurs de :
- Consulter les articles publiés
- Naviguer par catégories et tags
- Lire les commentaires
- Parcourir les contenus

### 4. ⚙️ Créer le site BackOffice
Développer l'interface d'administration pour :
- Créer, modifier, supprimer les articles
- Gérer les catégories et tags
- Gérer les utilisateurs et leurs permissions
- Modérer les commentaires
- Publier/dépublier les contenus

### 5. 🔍 Optimisation Référencement (SEO)
Mettre en place les meilleurs pratiques SEO :
- Balises meta (title, description, og tags)
- Structure des URLs (slugs)
- Sitemap et robots.txt
- Optimisation des performances (images, cache)
- Maillage interne et backlinks

---

## 🚀 Démarrage Rapide

### Prérequis
- Docker et Docker Compose
- Git

### Installation et Lancement

```bash
# 1. Cloner le projet
git clone <repo-url>
cd TP_SEO

# 2. Lancer le projet complet
./run.sh
```

C'est tout! Le script `run.sh` s'occupe de:
- ✅ Vérifier la structure des dossiers
- ✅ Démarrer PostgreSQL et PHP/Apache
- ✅ Initialiser la base de données
- ✅ Charger les données d'exemple

---

## 🌐 URLs d'Accès

| Service | URL |
|---------|-----|
| 🌍 **Frontend** | http://localhost:8001 |
| 🏗️ **Admin** | http://localhost:8001/admin |
| 📰 **Articles** | http://localhost:8001/articles |
| 🗄️ **PostgreSQL** | localhost:5432 (via Docker) |

---

## 📁 Structure du Projet

```
TP_SEO/
├── public/                 # 🌐 Racine web (DocumentRoot)
│   ├── index.php          # Point d'entrée principal
│   └── 404.php            # Page d'erreur 404
│
├── src/                   # 💻 Code applicatif
│   └── Core/
│       ├── Database.php   # Connexion PostgreSQL (PDO)
│       ├── Router.php     # Routeur simple
│       └── View.php       # Moteur de rendu (templates + partials)
│
├── views/                 # 📄 Templates HTML/PHP
│   ├── templates/         # Layouts globaux (frontend/admin/error)
│   ├── partials/          # Morceaux réutilisables (header/nav/footer)
│   ├── frontend/          # Pages publiques
│   │   ├── home.php      # Accueil
│   │   └── post-list.php # Liste articles
│   └── backend/           # Pages admin
│       ├── dashboard.php  # Tableau de bord
│       ├── posts/         # CRUD articles
│       ├── categories/    # CRUD catégories
│       ├── tags/          # CRUD tags
│       ├── post-categories/ # CRUD relation post_category
│       └── post-tags/     # CRUD relation post_tags
│
├── config/                # ⚙️ Configuration
│   ├── .env              # Variables d'environnement
│   ├── constants.php     # Constantes globales
│   └── routes.php        # Définition des routes
│
├── assets/                # 📦 Fichiers statiques
│   ├── css/
│   ├── js/
│   └── images/
│
├── sql/                   # 📊 Scripts BD
│   ├── base.sql          # Schéma
│   ├── donnee.sql        # Données test
│   └── recreat-base.sh   # Script recréation
│
├── docker-compose.yml     # Configuration Docker
├── Dockerfile.php         # Image PHP+Apache
├── run.sh                 # 🚀 Script de démarrage
├── STRUCTURE.md           # Documentation architecture
└── README.md              # Ce fichier
```

**→ Voir [STRUCTURE.md](STRUCTURE.md) pour les détails complets**

---

## 🗄️ Base de Données

### Configuration PostgreSQL
```
Host: postgres (dans Docker)
Port: 5432
User: postgres
Password: postgres
Database: tp_seo
```

### Tables principales
- **users** : Utilisateurs (admin, editor)
- **categories** : Catégories d'articles
- **posts** : Articles/contenus
- **post_category** : Relation N-N
- **tags** : Étiquettes
- **post_tags** : Relation N-N
- **comments** : Commentaires

---

## 💾 Gestion de la Base de Données

### Recréer la base (drop + create + données)
```bash
./sql/recreat-base.sh
```

### Accéder à PostgreSQL
```bash
docker-compose exec postgres psql -U postgres -d tp_seo
```

### Vider la base
```bash
./sql/vide-base.sh
```

---

## 🛠️ Commandes Utiles

### Démarrer le projet
```bash
./run.sh
```

### Arrêter le projet
```bash
docker-compose down
```

### Voir les logs PHP
```bash
docker-compose logs -f php
```

### Accéder au terminal PHP
```bash
docker-compose exec php bash
```

### Rebuild des images Docker
```bash
docker-compose up -d --build
```

---

## 🎨 Architecture PHP

### Routeur Simple
Les routes sont définies dans `config/routes.php`:

```php
$router->get('/', function () use ($posts) {
	View::render('frontend/home.php', ['posts' => $posts], 'frontend');
});

$router->get('/admin', function () use ($stats) {
	View::render('backend/dashboard.php', $stats, 'admin');
});

$router->get('/admin/categories', function () use ($categories) {
	View::render('backend/categories/list.php', ['categories' => $categories], 'admin');
});
```

### Accès à la Base de Données
```php
$db = $_SESSION['db']; // Instance PDO
$posts = $db->fetchAll("SELECT * FROM posts");
$post = $db->fetchOne("SELECT * FROM posts WHERE id = ?", [1]);
```

### Système de Templates
```php
View::render('frontend/home.php', [
	'posts' => $posts,
	'title' => 'Accueil - TP_SEO'
], 'frontend');

View::render('backend/dashboard.php', [
	'postsCount' => $postsCount,
	'usersCount' => $usersCount,
	'title' => 'Dashboard Admin - TP_SEO'
], 'admin');
```

Templates disponibles:
- `frontend` → layout public
- `admin` → layout backoffice
- `error` → layout pages d'erreur

Le template inclut automatiquement des partials (`header`, `nav`, `footer`) et injecte le contenu de la vue.

---

## 📋 Checklist Fonctionnalités

- [x] Structure projet organisée
- [x] Base de données PostgreSQL
- [x] Point d'entrée PHP/Apache
- [x] Routeur simple
- [x] Système de templates multi-layout
- [x] Page d'accueil frontend
- [x] Dashboard admin
- [x] CRUD catégories (admin)
- [x] CRUD tags (admin)
- [x] CRUD post_category (admin)
- [x] CRUD post_tags (admin)
- [ ] CRUD complet articles
- [ ] Gestion utilisateurs
- [ ] System d'authentification
- [ ] Optimisation SEO
- [ ] Tests & déploiement

---

## 🚀 Prochaines Étapes

1. **Implémenter les Controllers** - PostController, CategoryController, etc.
2. **Ajouter Models** - Classes pour représenter les entities
3. **Middleware d'authentification** - Protéger les routes admin
4. **Validation des données** - Sécuriser les inputs
5. **SEO** - Balises meta, sitemap, robots.txt
6. **Tests unitaires** - PHPUnit
7. **Déploiement** - Production server

---

## 📝 Support et Docs

- Voir [STRUCTURE.md](STRUCTURE.md) - Architecture détaillée du projet
- Voir `config/routes.php` - Exemples de routes
- Voir `src/Core/Database.php` - Utilisation BD

---

## 📄 Licence

Projet TP_SEO - 2026
