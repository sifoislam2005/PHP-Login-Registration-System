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

🛠️ Configuration Technique1. 
1. Base de Données (SQL),2. Connexion PHP (connexion.php)
"sql CREATE TABLE `informations` ( `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(191) NOT NULL, `email` varchar(191) NOT NULL, `phone` varchar(20) NOT NULL, `pass` varchar(191) NOT NULL, `psw_repeat` varchar(191) NOT NULL, `verify_token` varchar(191) DEFAULT NULL, `psw_verify_token` varchar(191) DEFAULT NULL, `verify_status` tinyint(2) NOT NULL DEFAULT 0, PRIMARY KEY (`id`) ) ","php <?php $host = 'localhost'; $user = 'root'; $pass = ''; // Password dyalk $db   = 'auth'; $con = mysqli_connect($host, $user, $pass, $db); ?> "
