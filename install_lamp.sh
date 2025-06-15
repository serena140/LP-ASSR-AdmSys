#!/bin/bash

echo "  INSTALLATION SERVEUR LAMP   "

echo "Mise à jour du système en cours..."
sudo apt-get update -y && sudo apt upgrade -y

echo "Installation des outils de base (curl, unzip, git, htop) en cours..."
sudo apt-get install -y curl unzip git htop

echo "Installation d'Apache en cours..."
sudo apt-get install -y apache2
sudo systemctl enable apache2
sudo systemctl start apache2

echo "Installation de MySQL Client en cours..."
sudo apt-get install mysql-client -y

echo "Connexion à la database MySQL sur RDS AWS, initialise la base database , créer les tables..."
mysql -u admin -p'projet-admsys' -h contact-db.c56w2wou09hn.eu-west-3.rds.amazonaws.com < /chemin/vers/init_db.sql

echo "Installation de Docker" 
sudo apt-get install docker.io -y
sudo systemctl start docker
sudo systemctl enable docker

echo "Installation de PHP et modules en cours..."
sudo apt-get install php libapache2-mod-php php-mysql -y

echo "Redémarrage d’Apache en cours, veuillez patienter..."
sudo systemctl restart apache2

echo "Configuration du répertoire web pour utiliser le dossier partagé Vagrant..."
sudo rm -rf /var/www/html
sudo ln -s /vagrant /var/www/html

echo "Création d'une page PHP de test"
echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/info.php > /dev/null

php -v
apache2 -v

echo "Installation LAMP terminée !"
echo "Tu peux tester PHP sur http://192.168.56.101/info.php ou sur http://192.168.56.102/info.php"