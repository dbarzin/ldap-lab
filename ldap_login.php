<?php

$ldap_host = '127.0.0.1';
$ldap_port = 389;
$ldap_user = 'cn=jdupont,dc=example,dc=org';
$ldap_password = '123456';

$ldap_conn = ldap_connect($ldap_host, $ldap_port);

ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

if (!$ldap_conn) {
    die("❌ Échec de la connexion.\n");
}

echo "✅ Connexion LDAP réussie !\n";

if (!@ldap_bind($ldap_conn, $ldap_user, $ldap_password)) {
    echo "❌ Échec du bind : " . ldap_error($ldap_conn) . "\n";
    exit;
}

echo "✅ Authentification LDAP réussies !\n";
