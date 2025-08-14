#!/usr/bin/bash

set -e
set -x

mkdir -p ./certs
cd ./certs

# 1. Crée la CA
openssl genrsa -out ca.key 2048
openssl req -x509 -new -nodes -key ca.key -sha256 -days 3650 -out ca.crt -subj "/CN=My Test CA"

# 2. Crée une clé pour le serveur LDAP
openssl genrsa -out ldap.key 2048

# 3. Crée une CSR (Certificate Signing Request)
openssl req -new -key ldap.key -out ldap.csr -subj "/CN=ldap.example.org"

# 4. Signe le certificat avec la CA
openssl x509 -req -in ldap.csr -CA ca.crt -CAkey ca.key -CAcreateserial -out ldap.crt -days 365 -sha256

# 5. Nettoyage
rm ldap.csr

