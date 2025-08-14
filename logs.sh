#!/usr/bin/bash
set -e
set -x

docker compose logs --tail=500 -f phpldapadmin
