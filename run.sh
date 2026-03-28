#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo "================================"
echo "🚀 Démarrage du Projet TP_SEO"
echo "================================"
echo ""

# Vérifier Docker
if ! command -v docker &> /dev/null; then
    echo "❌ Erreur: Docker n'est pas installé."
    exit 1
fi

if ! command -v docker-compose &> /dev/null && ! docker compose version >/dev/null 2>&1; then
    echo "❌ Erreur: docker-compose n'est pas disponible."
    exit 1
fi

# Déterminer la bonne commande docker compose
if docker compose version >/dev/null 2>&1; then
    COMPOSE_CMD=(docker compose)
else
    COMPOSE_CMD=(docker-compose)
fi

echo "📦 Vérification de la structure du projet..."
REQUIRED_DIRS=("public" "src" "config" "views" "assets" "sql" "database")
for dir in "${REQUIRED_DIRS[@]}"; do
    if [ ! -d "$SCRIPT_DIR/$dir" ]; then
        echo "✓ Création du dossier: $dir"
        mkdir -p "$SCRIPT_DIR/$dir"
    fi
done

echo ""
echo "🐳 Démarrage des conteneurs Docker..."
"${COMPOSE_CMD[@]}" -f "$SCRIPT_DIR/docker-compose.yml" up -d

echo ""
echo "⏳ Vérification de PostgreSQL..."
"${COMPOSE_CMD[@]}" -f "$SCRIPT_DIR/docker-compose.yml" exec -T postgres pg_isready -U postgres -d tp_seo

echo ""
echo "🗄️ Initialisation de la base de données..."
if [ -f "$SCRIPT_DIR/sql/recreat-base.sh" ]; then
    bash "$SCRIPT_DIR/sql/recreat-base.sh"
    echo "✓ Base de données initialisée"
else
    echo "⚠️ Attention: sql/recreat-base.sh non trouvé"
fi

echo ""
echo "================================"
echo "✅ Projet démarré avec succès !"
echo "================================"
echo ""
echo "📍 URLs disponibles:"
echo "   🌐 Frontend:  http://localhost:8001"
echo "   🏗️  Admin:     http://localhost:8001/admin"
echo "   📰 Articles:  http://localhost:8001/articles"
echo "   🗄️  PostgreSQL: localhost:5432"
echo ""
echo "💻 Commandes utiles:"
echo "   Voir les logs PHP:     ${COMPOSE_CMD[0]} ${COMPOSE_CMD[@]:1:1} logs -f php"
echo "   Voir les logs DB:      ${COMPOSE_CMD[0]} ${COMPOSE_CMD[@]:1:1} logs -f postgres"
echo "   Arrêter le projet:     ${COMPOSE_CMD[0]} ${COMPOSE_CMD[@]:1:1} down"
echo "   Accéder à PHP bash:    ${COMPOSE_CMD[0]} ${COMPOSE_CMD[@]:1:1} exec php bash"
echo "   Accéder à PostgreSQL:  ${COMPOSE_CMD[0]} ${COMPOSE_CMD[@]:1:1} exec postgres psql -U postgres -d tp_seo"
echo ""
