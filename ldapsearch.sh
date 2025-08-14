#!/usr/bin/bash
set -e
set -x

docker exec -it openldap ldapsearch -x -H ldap://localhost -D "cn=admin,dc=example,dc=org" -w admin -b "dc=example,dc=org"
