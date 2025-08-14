#!/usr/bin/bash
set -e
set -x

docker compose up -d --build

echo "Connect to http://localhost:8080"
