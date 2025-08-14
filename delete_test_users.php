<?php
// delete_test_users.php

$ldap_host = '127.0.0.1';
$ldap_port = 389;
$admin_dn = 'cn=admin,dc=example,dc=org';
$admin_pw = 'admin';
$base_dn = 'dc=example,dc=org';
$ou_dn = 'ou=testusers,' . $base_dn;

$ldap = ldap_connect($ldap_host, $ldap_port);
ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

if (!ldap_bind($ldap, $admin_dn, $admin_pw)) {
    exit("❌ Bind failed: " . ldap_error($ldap) . "\n");
}

// Rechercher les testusers
$search = ldap_list($ldap, $ou_dn, '(uid=testuser*)', ['dn']);

if ($search && ldap_count_entries($ldap, $search) > 0) {
    $entries = ldap_get_entries($ldap, $search);
    for ($i = 0; $i < $entries["count"]; $i++) {
        $dn = $entries[$i]["dn"];
        if (ldap_delete($ldap, $dn)) {
            echo "🗑 Deleted: $dn\n";
        } else {
            echo "⚠️ Failed to delete $dn: " . ldap_error($ldap) . "\n";
        }
    }
} else {
    echo "ℹ️ No test users found.\n";
}

// Supprimer l'OU elle-même
if (ldap_delete($ldap, $ou_dn)) {
    echo "🧹 Deleted OU: testusers\n";
} else {
    echo "⚠️ Failed to delete OU: " . ldap_error($ldap) . "\n";
}

ldap_unbind($ldap);

