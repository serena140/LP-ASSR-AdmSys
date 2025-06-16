# LP-ASSR-AdmSys-2024-25 - English version
System Administration Project with Mr. Cerin: Virtualized LAMP deployment using Docker and remote AWS RDS database.

## Objective
This project was carried out as part of the Professional License ASSR (2024-2025) at the IUT of Villetaneuse – Sorbonne Paris Nord University.
Its goal is to provide the SME MBF with a turnkey solution to:

- Set up a web contact form
- Centralize data in a MySQL database hosted on AWS RDS
- Deploy this solution in an automated, virtualized, and containerized way

## Project Structure
- Vagrantfile # Creates 2 Ubuntu VMs + runs the LAMP setup script
- install_lamp.sh # Bash script for automated LAMP stack installation
- init_db.sql # SQL script to create tables (leads, feedback)
- docker-php/
  - Dockerfile # Docker image for the PHP app
  - index.php # Homepage of the MBF site
  - contact.php # Contact form (Leads + Feedback)
  - style.css # Form design
- README-EN.md # This file
- README-FR.md # Same file in French version
- README-JAP.md # Same file in Japanese version
  
## Prerequisites

- [VirtualBox](https://www.virtualbox.org/) (v7.1.4 or higher)
- [Vagrant](https://developer.hashicorp.com/vagrant/downloads) (v2.4.5 or higher)
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- An AWS account with RDS enabled (MySQL 8.0)
  
## Deployment

### 1. Clone the project

```bash
git clone https://github.com/serena140/LP-ASSR-AdmSys.git
cd LP-ASSR-AdmSys
```

### 2. Start the VMs

```bash
vagrant up          # Automatically creates and configures 2 Ubuntu VMs  
vagrant ssh ubuntu_VM1   # Connect to the first machine
```
The VMs will have the IPs: 192.168.56.101 and 192.168.56.102

### 3. Create the database on AWS RDS
Create a MySQL 8.0 instance (name: contact-db)
Add security rules to allow IP range: 192.168.56.0/24 (port 3306)
Use the init_db.sql script to create the tables:
- leads: for commercial inquiries
- feedback: for customer feedback

### 4. Run the web application with Docker
```bash
cd docker-php
docker build -t appli-contact .
docker run -d -p 8080:80 --name projet-contact appli-contact
```
Access the app at: http://localhost:8080

## Tests performed
- Automatic VM creation via Vagrant
- Automated LAMP installation with Bash script
- Connection to remote MySQL database (AWS RDS)
- Containerization of the PHP application
- Functional forms (Leads and Feedback)
- Proper data storage in the database according to message type

## Additional documentation
For technical details, screenshots, architecture diagram, and commented code, see the PDF report.

## Author
Serena Paté - Professional License ASSR – 2024/2025
Sorbonne Paris Nord University – IUT of Villetaneuse
Supervisor: Christophe Cerin
