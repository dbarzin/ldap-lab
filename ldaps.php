<?php

putenv('LDAPTLS_REQCERT=never');

$ldap_conn = ldap_connect('ldaps://127.0.0.1', 636);

ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

if (!@ldap_bind($ldap_conn, 'cn=admin,dc=example,dc=org', 'admin')) {
    die("❌ Échec du bind : " . ldap_error($ldap_conn));
}

echo "✅ Connexion LDAPS réussie !\n";
