#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"
COMPOSE_FILE="$ROOT_DIR/docker-compose.yml"

# Variables de connexion PostgreSQL
user="postgres"
db="tp_seo"
password="postgres"
port="5432"
service="postgres"

if docker compose version >/dev/null 2>&1; then
	COMPOSE_CMD=(docker compose -f "$COMPOSE_FILE")
elif command -v docker-compose >/dev/null 2>&1; then
	COMPOSE_CMD=(docker-compose -f "$COMPOSE_FILE")
else
	echo "Erreur: docker compose/docker-compose introuvable."
	exit 1
fi

echo "Démarrage du service PostgreSQL ($service)..."
"${COMPOSE_CMD[@]}" up -d "$service"

run_psql() {
	"${COMPOSE_CMD[@]}" exec -T \
		-e PGPASSWORD="$password" \
		"$service" \
		psql -U "$user" -d "$db" -p "$port" -v ON_ERROR_STOP=1 "$@"
}

echo "Suppression de toutes les tables..."
run_psql <<'SQL'
DO $$
DECLARE
	r RECORD;
BEGIN
	FOR r IN (
		SELECT tablename
		FROM pg_tables
		WHERE schemaname = 'public'
	) LOOP
		EXECUTE format('DROP TABLE IF EXISTS public.%I CASCADE', r.tablename);
	END LOOP;
END
$$;
SQL

echo "Création des tables avec base.sql..."
run_psql -f - < "$SCRIPT_DIR/base.sql"

if [[ -f "$SCRIPT_DIR/donnee.sh" ]]; then
	echo "Exécution de donnee.sh..."
	DB_USER="$user" DB_NAME="$db" DB_PASSWORD="$password" DB_PORT="$port" DB_SERVICE="$service" DB_COMPOSE_FILE="$COMPOSE_FILE" bash "$SCRIPT_DIR/donnee.sh"
else
	echo "donnee.sh introuvable dans $SCRIPT_DIR"
fi

echo "Recréation de la base terminée."
