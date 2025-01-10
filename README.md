# Symfony_Site_Cuisine

Ce projet est un site web développé avec Symfony 7, réalisé en suivant la formation de Grafikart.

## Prérequis

- **PHP** : Version 8.2 ou supérieure
- **Composer** : Gestionnaire de dépendances PHP

## Installation

1. **Cloner le dépôt** :

   ```bash
   git clone https://github.com/Wharkk/Symfony_Site_Cuisine.git
   cd Symfony_Site_Cuisine
   ```

2. **Installer les dépendances PHP** :

   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript** :

   ```bash
   npm install
   ```

4. **Configurer les variables d'environnement** :

   Dupliquer le fichier `.env` et le renommer `.env.local`. Modifier les paramètres selon votre configuration (base de données, etc.).

5. **Exécuter les migrations de la base de données** :

   ```bash
   php bin/console doctrine:migrations:migrate
   ```

6. **Lancer le serveur de développement** :

   ```bash
   symfony server:start
   ```

   Le site sera accessible à l'adresse `http://localhost:8000`.

## Fonctionnalités

- Gestion des recettes de cuisine
- Ajout, modification et suppression de recettes
- Affichage des recettes avec leurs ingrédients et instructions

## Ressources

- [Documentation Symfony](https://symfony.com/doc/current/index.html)
- [Formation Symfony 7 par Grafikart](https://grafikart.fr/formations/symfony)

## Auteur

- **Wharkk** : Développeur du projet
