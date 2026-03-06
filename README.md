# 🔐 Système d'Authentification et de Gestion d'Utilisateurs PHP

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)

Un système d'authentification complet et sécurisé développé en PHP. Ce projet gère tout le cycle de vie d'un utilisateur, de l'inscription avec vérification par e-mail à la récupération de mot de passe sécurisée.

---

## 🚀 Fonctionnalités

* **📝 Inscription Utilisateur :** Collecte sécurisée des données (Nom, E-mail, Téléphone, Password).
* **📧 Vérification d'E-mail :** Envoi automatique d'un lien de vérification via **SMTP Gmail** (PHPMailer).
* **🔑 Connexion Sécurisée :** Vérification des identifiants et du statut d'activation du compte.
* **🔄 Réinitialisation de Mot de Passe :** Système de "Mot de passe oublié" avec génération de **tokens** uniques.
* **🛡️ Gestion de Session :** Protection du `Dashboard.php` (accès restreint aux membres connectés).
* **🎨 Interface Modulaire :** Structure propre avec `header.php`, `navbar.php` et `footer.php`.

---

## 🛠️ Technologies Utilisées

* **Backend :** PHP 8.x (Mélange Procédural & POO)
* **Base de données :** MySQL (Utilisation de `mysqli` avec **requêtes préparées**)
* **Envoi d'e-mails :** [PHPMailer](https://github.com/PHPMailer/PHPMailer)
* **Frontend :** HTML5, CSS3, Bootstrap (optionnel)

---

## 📋 Prérequis

1.  **Serveur Local :** XAMPP, WAMP ou Laragon.
2.  **Composer :** Pour l'installation des dépendances.
3.  **Compte Gmail :** Avec un "Mot de passe d'application" activé pour le SMTP.

---

## 🔧 Installation et Configuration

### 1. Base de Données
Créez une DB nommée `auth` et exécutez le script SQL suivant :

```sql
CREATE TABLE `informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pass` varchar(191) NOT NULL,
  `psw_repeat` varchar(191) NOT NULL,
  `verify_token` varchar(191) DEFAULT NULL,
  `psw_verify_token` varchar(191) DEFAULT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=non vérifié, 1=vérifié',
  PRIMARY KEY (`id`)
) 
2. Paramètres de Connexion
Configurez votre fichier connexion.php :

PHP
$host = 'localhost';
$user = 'root';
$pass = ''; // Votre mot de passe
$db   = 'auth';
3. Installation de PHPMailer
Lancez la commande suivante à la racine du projet :

Bash
composer require phpmailer/phpmailer
[!IMPORTANT]
N'oubliez pas de mettre à jour vos identifiants Gmail (Email + App Password) dans code.php et forgot.php.

📂 Structure du Projet
Plaintext
├── include/              # Composants UI (header, navbar, footer)
├── vendor/               # Dépendances Composer (PHPMailer)
├── index.php             # Page d'accueil
├── register.php          # Inscription
├── login.php             # Connexion
├── code.php              # Logique Backend (Traitement POST)
├── verify-email.php      # Validation du token e-mail
├── forgot.php            # Demande de reset password
├── reset-password.php    # Formulaire nouveau password
└── Dashboard.php         # Espace membre sécurisé
🛡️ Sécurité Implémentée
Anti-Injection SQL : Utilisation systématique des requêtes préparées.

Tokens MD5 : Génération de jetons uniques pour la validation et la récupération.

Double Vérification : Connexion impossible sans activation préalable de l'e-mail (verify_status).
