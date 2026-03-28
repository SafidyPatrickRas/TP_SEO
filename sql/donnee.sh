#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Variables récupérées depuis recreat-base.sh
user="${DB_USER:-postgres}"
db="${DB_NAME:-tp_seo}"
password="${DB_PASSWORD:-postgres}"
port="${DB_PORT:-5432}"
service="${DB_SERVICE:-postgres}"
compose_file="${DB_COMPOSE_FILE:-$SCRIPT_DIR/../docker-compose.yml}"

if docker compose version >/dev/null 2>&1; then
	COMPOSE_CMD=(docker compose -f "$compose_file")
elif command -v docker-compose >/dev/null 2>&1; then
	COMPOSE_CMD=(docker-compose -f "$compose_file")
else
	echo "Erreur: docker compose/docker-compose introuvable."
	exit 1
fi

echo "Insertion des données..."
"${COMPOSE_CMD[@]}" exec -T \
	-e PGPASSWORD="$password" \
	"$service" \
	psql -U "$user" -d "$db" -p "$port" -v ON_ERROR_STOP=1 -f - < "$SCRIPT_DIR/donnee.sql"

echo "Données insérées avec succès."
