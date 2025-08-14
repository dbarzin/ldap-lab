# LDAP Test Environment with LDAPS

This project provides a simple, self-contained LDAP test environment using Docker and OpenLDAP, with LDAPS support (LDAP over SSL). It allows you to generate certificates, run a secure LDAP server, and test LDAP connections and authentication using PHP and command-line tools.

## 📦 Project Structure

### 🐳 Docker & Setup Scripts

| File | Description |
|------|-------------|
| `docker-compose.yml` | Defines the Docker services: OpenLDAP and PhpLDAPadmin with port mappings and TLS settings. |
| `start.sh` | Starts the LDAP environment using Docker Compose. |
| `stop.sh` | Stops and removes the Docker containers. |
| `ps.sh` | Shows the status of the Docker containers. |
| `logs.sh` | Displays the logs of the OpenLDAP container. |

### 🔐 Certificates

| File / Folder | Description |
|---------------|-------------|
| `generate_certs.sh` | Script to generate a self-signed certificate authority (CA) and a server certificate for LDAPS. |
| `certs/` | Directory containing the generated certificates (`ca.crt`, `ldap.crt`, `ldap.key`). Mounted into the LDAP container. |

### 🧪 PHP Test Scripts

| File | Description |
|------|-------------|
| `ldap_con.sh` | Shell script that tests a basic (non-TLS) LDAP connection using `ldapsearch`. |
| `ldap_login.php` | PHP script that tests a basic LDAP connection and user authentication (bind). |
| `ldap_search.php` | PHP script that performs a search query on the LDAP directory over plain LDAP. |
| `ldaps.php` | PHP script that connects securely to the LDAP server using LDAPS (port 636) and authenticates. |

### 🧪 Command-Line LDAPS Test Scripts

| File | Description |
|------|-------------|
| `ldapsearch.sh` | Performs a basic LDAP search using `ldapsearch` over LDAP (port 389). |
| `ldaps_search.sh` | Performs a secure LDAP search using `ldapsearch` over LDAPS (port 636). Ignores certificate verification errors. |


---

## 🚀 Quick Start

1. Generate the certificates:

```bash
./generate_certs.sh
````

2. Start the LDAP environment:

```bash
./start.sh
```

3. Open PhpLDAPadmin in your browser:

   * [http://localhost:8080](http://localhost:8080)
   * Login DN: `cn=admin,dc=example,dc=org`
   * Password: `admin`

4. Run the test scripts (PHP or shell) to validate your setup.

---

## 🛠 Requirements

* Docker + Docker Compose v2
* PHP with LDAP extension (`php-ldap`)
* `openssl`, `ldap-utils` (for CLI tools like `ldapsearch`)

---

## 📚 Notes

* The certificate is self-signed. By default, clients will reject it unless explicitly told not to check (`TLS_REQCERT never`) or the CA is trusted.
* For real use, replace the test certificates with ones signed by a real CA or your enterprise CA.

---

Happy testing!
