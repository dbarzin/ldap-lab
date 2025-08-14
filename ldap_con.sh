<?php
$ldap_conn = ldap_connect('127.0.0.1', 389);

if (!$ldap_conn) {
    die("❌ Impossible de se connecter au serveur LDAP.\n");
}

ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

echo "✅ Connexion au serveur LDAP OK\n";
