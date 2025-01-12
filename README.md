# **Drive & Loc**

## **Contexte du Projet**

Ce projet vise à développer une plateforme complète de gestion de location de véhicules pour l'agence **Drive & Loc**, permettant aux clients de rechercher, réserver, et évaluer des véhicules en ligne, tout en offrant une interface d'administration robuste pour la gestion des réservations, des véhicules et des avis. L'objectif est de créer une plateforme dynamique et fonctionnelle répondant à la fois aux attentes des utilisateurs finaux et des administrateurs.

## **Objectifs du Projet**

La plateforme doit offrir une gestion multi-rôles, avec une expérience fluide pour les clients (exploration, réservation et évaluation des véhicules) et une interface de gestion centralisée pour les administrateurs (gestion des réservations, des véhicules, des avis, statistiques et contrôle des utilisateurs).

## **Table des Matières**
- [Fonctionnalités](#fonctionnalités)
- [Technologies Utilisées](#technologies-utilisées)
- [Liens Utiles](#liens-utiles)
- [Installation](#installation)
- [Structure de la Base de Données](#structure-de-la-base-de-données)
- [API et Services](#api-et-services)

## **Fonctionnalités**

### **Version I - Location de Véhicules**
- **Multi-Rôles** : Les utilisateurs peuvent être des **clients** ou des **administrateurs**.
- **Inscription/Connexion** : Les clients doivent se connecter pour accéder aux fonctionnalités de réservation.
- **Exploration des Véhicules** : Les clients peuvent parcourir les véhicules disponibles, avec possibilité de filtrer par catégorie.
- **Réservation de Véhicules** : Les clients peuvent réserver un véhicule en spécifiant les dates et les lieux de prise en charge.
- **Recherche et Filtrage Dynamique** : Les clients peuvent rechercher un véhicule spécifique ou filtrer les véhicules par catégorie sans rafraîchir la page.
- **Avis et Évaluations** : Les clients peuvent ajouter, modifier ou supprimer leurs avis (Soft Delete).
- **Pagination** : Affichage des véhicules avec pagination, pour améliorer l’expérience utilisateur.
- **Gestion des Avis par l'Administrateur** : Les administrateurs peuvent approuver ou supprimer des avis.
- **Tableau de Bord Administrateur** : Gestion des véhicules, réservations, catégories, et statistiques.
- **Ajouter des Options Supplémentaires** : Les clients peuvent ajouter des options supplémentaires lors de la réservation (GPS, siège enfant, etc.).

### **Version II - Blog Automobiles**
- **Exploration du Blog** : Les clients peuvent explorer différents thèmes du blog.
- **Création d'Articles** : Les clients peuvent soumettre des articles, incluant un titre, du contenu, des images/vidéos (optionnel).
- **Commentaires sur les Articles** : Les clients peuvent ajouter, modifier, ou supprimer leurs commentaires.
- **Favoris d'Articles** : Possibilité pour les clients d'ajouter des articles à leurs favoris.
- **Gestion du Blog par l'Administrateur** : Les administrateurs peuvent gérer les thèmes, articles, tags et commentaires.
- **Statistiques sur les Articles** : Tableau de bord pour les administrateurs analysant les performances des articles et commentaires.

### **Fonctionnalités Supplémentaires (Bonus)**
- **Validation de Réservation par Email** : Les administrateurs peuvent approuver ou refuser des réservations et envoyer un email de notification.
- **Statistiques d'Engagement** : Tableaux de bord pour suivre l'engagement des utilisateurs (likes, commentaires, etc.).
- **Historique de Lecture des Articles** : Les clients peuvent consulter l’historique des articles qu’ils ont lus.

## **Technologies Utilisées**
- **PHP (POO)** : Logique serveur et gestion des fonctionnalités backend.
- **SQL** : Gestion de la base de données et des requêtes.
- **MySQL** : Système de gestion de base de données relationnelle.
- **AJAX** : Pour les interactions dynamiques sans rafraîchissement de la page.
- **Tailwind CSS** : Pour le design responsive et les composants frontend.
- **JavaScript (DataTable)** : Pour la gestion interactive et dynamique de la pagination dans les listes.

## **Liens Utiles**
- **Présentation du projet**: [Lien vers la présentation](https://www.canva.com/design/DAGcBcpVmsk/M4YmU8f8Spdaz_Nl9xhloQ/edit?utm_content=DAGcBcpVmsk&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)
- **Dépôt GitHub**: [Lien vers le dépôt GitHub](https://github.com/ali-rostom1/drive-loc-v2)
- **Planification du projet (GitHub Projects)**: [Lien vers GitHub Projects](https://github.com/users/ali-rostom1/projects/7)

## **Installation**

1. Clonez le dépôt depuis GitHub :
   ```bash
   git clone https://github.com/ali-rostom1/drive-loc-v2.git
