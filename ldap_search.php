<?php

$ldap_host = '127.0.0.1';
$ldap_port = 389;
$ldap_user = 'cn=admin,dc=example,dc=org';
$ldap_password = 'admin';
$base_dn = 'dc=example,dc=org';
$filter = '(objectClass=*)';

$ldap_conn = ldap_connect($ldap_host, $ldap_port);
ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

if (!$ldap_conn) {
    die("❌ Échec de la connexion.\n");
}

if (!@ldap_bind($ldap_conn, $ldap_user, $ldap_password)) {
    echo "❌ Échec du bind : " . ldap_error($ldap_conn) . "\n";
    exit;
}

echo "✅ Connexion et authentification LDAP réussies !\n";

$search = @ldap_search($ldap_conn, $base_dn, $filter);

if (!$search) {
    echo "❌ ldap_search() a échoué : " . ldap_error($ldap_conn) . "\n";
    exit;
}

$entries = ldap_get_entries($ldap_conn, $search);

echo "✅ Résultats de la recherche :\n";
print_r($entries);
