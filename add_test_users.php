<?php
// add_test_users.php

$ldap_host = '127.0.0.1';
$ldap_port = 389;
$admin_dn = 'cn=admin,dc=example,dc=org';
$admin_pw = 'admin';
$base_dn = 'dc=example,dc=org';
$ou_dn = 'ou=testusers,' . $base_dn;

// Connexion LDAP
$ldap = ldap_connect($ldap_host, $ldap_port);
ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

if (!ldap_bind($ldap, $admin_dn, $admin_pw)) {
    exit("❌ Bind failed: " . ldap_error($ldap) . "\n");
}

// Créer l'OU si elle n'existe pas
$check = ldap_list($ldap, $base_dn, "(ou=testusers)");
if (ldap_count_entries($ldap, $check) === 0) {
    $entry = [
        'objectClass' => ['top', 'organizationalUnit'],
        'ou' => 'testusers',
    ];
    ldap_add($ldap, $ou_dn, $entry);
    echo "✅ Created OU: testusers\n";
}

// Créer 10 utilisateurs
for ($i = 1; $i <= 10; $i++) {
    $uid = sprintf('testuser%02d', $i);
    $dn = "uid=$uid,$ou_dn";
    $entry = [
        'objectClass' => ['inetOrgPerson', 'posixAccount', 'top'],
        'cn' => "Test User $i",
        'sn' => "User$i",
        'uid' => $uid,
        'uidNumber' => 1000 + $i,
        'gidNumber' => 100,
        'homeDirectory' => "/home/$uid",
        'loginShell' => '/bin/bash',
        'userPassword' => '{SHA}' . base64_encode(sha1('password', true)), // mot de passe : "password"
    ];

    if (ldap_add($ldap, $dn, $entry)) {
        echo "➕ Created user: $uid\n";
    } else {
        echo "⚠️ Failed to create $uid: " . ldap_error($ldap) . "\n";
    }
}

ldap_unbind($ldap);
