# LP-ASSR-AdmSys-2024-25
Projet d'Administration Système avec M. Cerin : Projet de déploiement LAMP virtualisé avec Docker et BDD distante AWS RDS.

## Objectif
Ce projet a été réalisé dans le cadre de la Licence Professionnelle ASSR (2024-2025) à l'IUT de Villetaneuse – Université Sorbonne Paris Nord.  
Il a pour but de fournir à la PME MBF une solution clé en main pour :

- Mettre en place un formulaire de contact web
- Centraliser les données dans une base MySQL hébergée sur AWS RDS
- Déployer cette solution de manière automatisée, virtualisée et conteneurisée

## Structure du projet
├── Vagrantfile # Crée 2 VM Ubuntu + lance le script LAMP
├── install_lamp.sh # Script Bash : installation automatisée de la pile LAMP
├── init_db.sql # Script SQL : création des tables (leads, feedback)
├── docker-php/
│ ├── Dockerfile # Image Docker pour l'app PHP
│ ├── index.php # Page d'accueil du site MBF
│ ├── contact.php # Formulaire de contact (Leads + Feedback)
│ └── style.css # Design du formulaire
└── README.md # Ce fichier

- Vagrantfile # Crée 2 VM Ubuntu + lance le script LAMP
- install_lamp.sh # Script Bash : installation automatisée de la pile LAMP
- init_db.sql # Script SQL : création des tables (leads, feedback)
- docker-php/
  - Dockerfile # Image Docker pour l'app PHP
  - index.php # Page d'accueil du site MBF
  - contact.php # Formulaire de contact (Leads + Feedback)
  - style.css # Design du formulaire
- README.md # Ce fichier

## Prérequis

- [VirtualBox](https://www.virtualbox.org/) (v7.1.4 ou +)
- [Vagrant](https://developer.hashicorp.com/vagrant/downloads) (v2.4.5 ou +)
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- Un compte AWS avec RDS activé (MySQL 8.0)

## Déploiement

### 1. Cloner le projet

```bash
git clone https://github.com/serena140/LP-ASSR-AdmSys.git
cd LP-ASSR-AdmSys
```

### 2. Lancer les VM

```bash
vagrant up          # Crée et configure automatiquement 2 VM Ubuntu
vagrant ssh ubuntu_VM1   # Connexion à la première machine
```
Les VM auront les IP : 192.168.56.101 et 192.168.56.102

### 3. Créer la base de données sur AWS RDS
Créer une instance MySQL 8.0 (nom : contact-db)
Ajouter les règles de sécurité pour autoriser les IP : 192.168.56.0/24 (port 3306)
Utiliser le script init_db.sql pour créer les tables :
- leads : pour les demandes commerciales
- feedback : pour les retours clients


