#!/usr/bin/bash

LDAPTLS_REQCERT=never ldapsearch -H ldaps://localhost:636 -x -D "cn=admin,dc=example,dc=org" -w admin -b "dc=example,dc=org"

