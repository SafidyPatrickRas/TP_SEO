#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR"

echo "[docker] Démarrage de PostgreSQL via docker compose..."
docker compose up -d

echo "[docker] Statut des services :"
docker compose ps
