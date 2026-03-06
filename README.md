<div align="center">

# 🔐 Système d'Authentification et de Gestion d'Utilisateurs PHP

**Un système d'authentification complet, sécurisé et modulaire développé avec PHP & MySQL**

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PHPMailer](https://img.shields.io/badge/PHPMailer-SMTP-red?style=for-the-badge&logo=gmail&logoColor=white)
![Licence](https://img.shields.io/badge/Licence-MIT-green?style=for-the-badge)
![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)

</div>

---

## 📖 Présentation

Un **système d'authentification PHP** prêt pour la production, couvrant l'intégralité du cycle de vie utilisateur — de l'inscription et la vérification par e-mail jusqu'à la connexion sécurisée, la gestion des sessions et la récupération de mot de passe. Développé avec les paradigmes procédural et orienté objet, en utilisant systématiquement les requêtes préparées `mysqli` pour se prémunir contre les injections SQL.

---

## ✨ Fonctionnalités

- 📝 **Inscription utilisateur** — Collecte du nom, e-mail, téléphone et mot de passe avec confirmation
- ✅ **Vérification par e-mail** — Lien de vérification par jeton envoyé via SMTP avec PHPMailer
- 🔑 **Connexion sécurisée** — Authentification par session avec vérification d'e-mail obligatoire
- 🔒 **Réinitialisation du mot de passe** — Jeton envoyé par e-mail pour une récupération sécurisée
- 🛡️ **Tableau de bord protégé** — Page accessible uniquement après connexion, gardée par session
- 🧩 **Interface modulaire** — Composants réutilisables : `header.php`, `navbar.php`, `footer.php`
- 💬 **Messages flash** — Notifications de statut via sessions sur toutes les pages
- 🗃️ **Requêtes préparées** — Toutes les interactions avec la base de données utilisent `mysqli` avec `bind_param()`

---

## 🛠️ Technologies utilisées

| Technologie | Rôle |
|---|---|
| **PHP 8.x** | Logique backend (Procédural & POO) |
| **MySQL** | Base de données relationnelle via l'extension `mysqli` |
| **PHPMailer** | Envoi d'e-mails via SMTP (Gmail) |
| **Composer** | Gestionnaire de dépendances |
| **Sessions PHP** | Gestion de l'état de connexion et messages flash |

---

## 📁 Structure du projet

```
auth-php/
│
├── index.php                  # Page d'accueil
├── register.php               # Formulaire d'inscription (UI)
├── login.php                  # Formulaire de connexion (UI)
├── forgot.php                 # Formulaire mot de passe oublié (UI + logique)
├── reset-password.php         # Formulaire de réinitialisation (UI + logique)
├── verify-email.php           # Traitement du jeton de vérification d'e-mail
├── Dashboard.php              # Tableau de bord utilisateur protégé
│
├── code.php                   # Logique principale : inscription & connexion
├── connexion.php              # Connexion à la base de données MySQL
│
├── include/
│   ├── header.php             # Balise <head>, liens CSS
│   ├── navbar.php             # Barre de navigation
│   └── footer.php            # Pied de page, balises de fermeture
│
└── vendor/                    # Dépendances Composer (PHPMailer, etc.)
    └── autoload.php
```

---

## 🗄️ Configuration de la base de données

### 1. Créer la base de données

```sql
CREATE DATABASE auth;
USE auth;
```

### 2. Créer la table `informations`

```sql
CREATE TABLE informations (
    id               INT(11)         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name             VARCHAR(100)    NOT NULL,
    email            VARCHAR(150)    NOT NULL UNIQUE,
    phone            VARCHAR(20)     NOT NULL,
    pass             VARCHAR(255)    NOT NULL,
    psw_repeat       VARCHAR(255)    NOT NULL,
    verify_token     VARCHAR(255)    DEFAULT NULL,
    verify_status    TINYINT(1)      NOT NULL DEFAULT 0,
    psw_verify_token VARCHAR(255)    DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## ⚙️ Installation

### Étape 1 — Cloner le dépôt

```bash
git clone https://github.com/votre-utilisateur/auth-php.git
cd auth-php
```

### Étape 2 — Installer les dépendances via Composer

```bash
composer require phpmailer/phpmailer
```

### Étape 3 — Configurer la connexion à la base de données

Modifiez `connexion.php` avec vos identifiants locaux :

```php
<?php
$host = 'localhost';
$user = 'root';       // Votre nom d'utilisateur MySQL
$pass = '';           // Votre mot de passe MySQL
$db   = 'auth';       // Le nom de la base de données créée

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
    die("Échec de la connexion : " . $con->connect_error);
}

$con->set_charset("utf8mb4");
?>
```

### Étape 4 — Importer la base de données

```bash
mysql -u root -p auth < database/auth.sql
```

> Ou exécutez le SQL de l'[Étape 2](#2-créer-la-table-informations) manuellement via phpMyAdmin ou MySQL Workbench.

---

## 📧 Configuration SMTP

> [!WARNING]
> Les identifiants SMTP dans `code.php` et `forgot.php` sont **en dur dans le code** à des fins de démonstration. **Ne committez jamais de vrais identifiants dans un dépôt public.** Avant tout déploiement, déplacez ces valeurs dans un fichier `.env` ou un `config.php` exclu par `.gitignore`.

Modifiez les paramètres du mailer dans `code.php` et `forgot.php` :

```php
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'votre-email@gmail.com';
$mail->Password   = 'votre-mot-de-passe-application'; // Utilisez un Mot de passe d'application Gmail
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;
```

> 💡 Gmail exige l'utilisation d'un **Mot de passe d'application** (et non votre mot de passe habituel). Activez-le via : `Compte Google → Sécurité → Validation en deux étapes → Mots de passe des applications`.

---

## 🔐 Sécurité

| Fonctionnalité | Implémentation |
|---|---|
| **Protection contre les injections SQL** | Toutes les requêtes utilisent les requêtes préparées `mysqli` avec `bind_param()` |
| **Jetons de vérification d'e-mail** | Générés avec `md5(rand())` — unique par inscription |
| **Jetons de réinitialisation** | Générés avec `md5(rand() . time())` — invalidés après usage (`SET psw_verify_token = NULL`) |
| **Protection par session** | Les sessions PHP sécurisent le tableau de bord et les messages flash |
| **Traitement des entrées** | Les données des formulaires sont liées via requêtes préparées avant toute interaction avec la BDD |

> [!NOTE]
> Pour un environnement de production, pensez à migrer le stockage des mots de passe vers **`password_hash()` / `password_verify()`** plutôt qu'en texte brut, et remplacez les jetons `md5()` par **`bin2hex(random_bytes(32))`** pour des jetons cryptographiquement sécurisés.

---

## 🚀 Utilisation

1. Démarrez votre serveur local (XAMPP / Laragon / WAMP)
2. Rendez-vous sur `http://localhost/auth-php/index.php`
3. Créez un nouveau compte via le formulaire d'inscription
4. Consultez votre boîte mail et cliquez sur le lien de vérification
5. Connectez-vous et accédez au tableau de bord
6. Testez la réinitialisation du mot de passe via le lien *Mot de passe oublié*

---

## 📄 Licence

Ce projet est sous licence **MIT** — consultez le fichier [LICENSE](LICENSE) pour plus de détails.

---

<div align="center">
  Fait avec ❤️ par <strong>SEYF</strong>
</div>
