Système d'Authentification et de Gestion d'Utilisateurs PHP
Un système d'authentification complet et sécurisé développé en PHP (mélange de procédural et d'orienté objet). Ce projet gère tout le cycle de vie d'un utilisateur, de l'inscription avec vérification par e-mail à la récupération de mot de passe via PHPMailer.

🚀 Fonctionnalités
Inscription Utilisateur : Collecte le nom, l'e-mail, le téléphone et le mot de passe.

Vérification d'E-mail : Envoi automatique d'un lien de vérification via SMTP Gmail pour activer le compte.

Connexion Sécurisée : Vérifie les identifiants et s'assure que l'e-mail est validé avant l'accès.

Réinitialisation de Mot de Passe : Système de "Mot de passe oublié" envoyant un jeton (token) sécurisé par e-mail.

Gestion de Session : Protection du tableau de bord (Dashboard.php) accessible uniquement aux utilisateurs connectés.

Interface Modulaire : Structure organisée avec des fichiers inclus pour l'en-tête, la navigation et le pied de page (header.php, navbar.php, footer.php).

🛠️ Technologies Utilisées
Backend : PHP 8.x

Base de données : MySQL (utilisation de mysqli avec requêtes préparées pour la sécurité)

Envoi d'e-mails : PHPMailer (via Composer)

Frontend : HTML5, CSS3

📋 Prérequis
XAMPP / WAMP installé sur votre machine.

Composer (pour gérer les dépendances de PHPMailer).

Un compte Gmail avec un "Mot de passe d'application" configuré pour le SMTP.

🔧 Installation et Configuration
1. Configuration de la Base de Données
Créez une base de données nommée auth dans phpMyAdmin et exécutez le SQL suivant pour créer la table informations :

SQL
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
Modifiez le fichier connexion.php avec vos accès locaux :

PHP
$host = 'localhost';
$user = 'root';
$pass = ''; // Votre mot de passe
$db   = 'auth';
3. Installation de PHPMailer
Si le dossier vendor est absent, installez PHPMailer via votre terminal :

Bash
composer require phpmailer/phpmailer
Note : N'oubliez pas de mettre à jour vos identifiants Gmail dans code.php et forgot.php.

📂 Structure du Projet
index.php : Page d'accueil.

register.php : Formulaire d'inscription.

login.php : Formulaire de connexion.

code.php : Logique backend (traitement POST pour l'inscription et la connexion).

verify-email.php : Gestion de la validation du lien reçu par e-mail.

forgot.php : Demande de réinitialisation de mot de passe.

reset-password.php : Formulaire de saisie du nouveau mot de passe via token.

Dashboard.php : Espace membre sécurisé.

include/ : Composants UI (header.php, navbar.php, footer.php).

🛡️ Sécurité implémentée
Requêtes Préparées : Utilisées dans code.php et reset-password.php contre les injections SQL.

Vérification par Token : Utilisation de jetons MD5 uniques pour la validation d'e-mail et la récupération de compte.

Validation de Statut : Un utilisateur ne peut pas se connecter si son verify_status est égal à 0.
