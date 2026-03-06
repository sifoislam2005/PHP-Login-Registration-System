🛡️ Système d'Authentification PHP (DevSifo)
Un système complet et sécurisé de gestion d'utilisateurs développé en PHP. Ce projet inclut l'inscription, la connexion, la vérification d'e-mail par SMTP et la récupération de mot de passe.

✨ Fonctionnalités
Inscription Sécurisée : Validation des données et vérification d'unicité d'e-mail.

Vérification d'E-mail : Envoi automatique d'un jeton (token) via PHPMailer pour activer le compte.

Authentification Robuste : Gestion de session utilisateur et protection des pages.

Réinitialisation de Mot de Passe : Système sécurisé par token envoyé par e-mail.

Sécurité des Données : Utilisation de requêtes préparées (Prepared Statements) pour prévenir les injections SQL.

Interface Modulaire : Architecture utilisant des includes pour une maintenance facilitée du Header, Navbar et Footer.

🚀 Technologies Utilisées
Backend : PHP 8.x

Base de données : MySQL

Bibliothèques : PHPMailer (via Composer)

Frontend : HTML5, CSS3, Google Fonts

📂 Structure du Projet
Plaintext
.
├── include/              # Composants UI (header.php, navbar.php, footer.php)
├── vendor/               # Dépendances Composer (PHPMailer)
├── connexion.php         # Configuration de la base de données
├── code.php              # Logique métier (Logic Register/Login)
├── register.php          # Formulaire d'inscription
├── login.php             # Formulaire de connexion
├── verify-email.php      # Script de validation du token e-mail
├── forgot.php            # Demande de réinitialisation de mot de passe
├── reset-password.php    # Formulaire de nouveau mot de passe
├── dashboard.php         # Espace membre protégé
└── index.php             # Page d'accueil
🛠️ Installation & Configuration
1. Base de données
Créez une base de données nommée auth et exécutez le script SQL suivant :

SQL
CREATE TABLE `informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pass` varchar(191) NOT NULL,
  `verify_token` varchar(191) DEFAULT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0,
  `psw_verify_token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
2. Dépendances
Installez PHPMailer via Composer :

Bash
composer require phpmailer/phpmailer
3. Configuration SMTP
Modifiez les paramètres de messagerie dans code.php et forgot.php :

[!WARNING]
Sécurité SMTP : Ne poussez jamais vos identifiants réels (Username/Password) sur un dépôt public. Utilisez des variables d'environnement ou un fichier de configuration ignoré par Git.

🔒 Sécurité Implémentée
Anti-SQL Injection : Utilisation systématique de $con->prepare() et bind_param() pour toutes les requêtes utilisateur.

Tokens Uniques : Génération de jetons MD5 basés sur des fonctions aléatoires pour la vérification et le reset.

Protection des Sessions : Vérification du statut de validation (verify_status) avant d'autoriser l'accès au tableau de bord.

🤝 Contribution
Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une Issue ou à soumettre une Pull Request
