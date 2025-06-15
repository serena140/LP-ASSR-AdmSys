<?php

$servername = "contact-db.c56w2wou09hn.eu-west-3.rds.amazonaws.com";
$username = "admin";
$password = "projet-admsys";
$dbname = "contact_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $message = $_POST['message'];

  if ($type == 'lead') {
    // Informations spécifiques au lead commercial
    $service = $_POST['service'];
    $budget = $_POST['budget'];

    $sql = "INSERT INTO leads (name, email, service, budget, message) VALUES ('$name', '$email', '$service', '$budget', '$message')";

  } else if ($type == 'feedback') {
    // Informations spécifiques au feedback client
    $product = $_POST['product'];
    $satisfaction = $_POST['satisfaction'];
    $suggestions = $_POST['suggestions'];

    $sql = "INSERT INTO feedback (name, email, product, satisfaction, suggestions, message) VALUES ('$name', '$email', '$product', '$satisfaction', '$suggestions', '$message')";
  }

    if ($conn->query($sql) === TRUE) {
        echo "Votre message a été envoyé avec succès !";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .extra-fields {
            display: none;
        }
    </style>
</head>

<body>
    <h2>Formulaire de contact</h2>
    <form action="contact.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="type">Type de message :</label>
        <select id="type" name="type" required>
            <option value="">Sélectionnez...</option>
            <option value="lead">Lead commercial</option>
            <option value="feedback">Feedback client</option>
        </select><br><br>

        <div id="lead-fields" style="display:none;">
            <label for="service">Quel service vous intéresse ?</label>
            <select id="service" name="service">
                <option value="support">Support Technique</option>
                <option value="marketing">Service Marketing</option>
                <option value="comptabilité">Service Comptabilité</option>
            </select><br><br>

            <label for="budget">Quel est votre budget ?</label>
            <input type="text" id="budget" name="budget"><br><br>
        </div>

        <div id="feedback-fields" class="extra-fields">
            <label for="product">Quel produit avez-vous utilisé ?</label>
            <input type="text" id="product" name="product"><br><br>

            <label for="satisfaction">Satisfaction (1 à 5) :</label>
            <input type="number" id="satisfaction" name="satisfaction" min="1" max="5"><br><br>

            <label for="suggestions">Suggestions :</label>
            <textarea id="suggestions" name="suggestions"></textarea><br><br>
        </div>

        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="6" required></textarea><br><br>

        <input type="submit" value="Envoyer">
    </form>

    <script>
    // JavaScript pour afficher/masquer les champs en fonction du type de demande sélectionné
        document.getElementById('type').addEventListener('change', function() {
            var type = this.value;
            if (type == 'lead') {
            document.getElementById('lead-fields').style.display = 'block';
            document.getElementById('feedback-fields').style.display = 'none';
            } else if (type == 'feedback') {
            document.getElementById('lead-fields').style.display = 'none';
            document.getElementById('feedback-fields').style.display = 'block';
            }
        });
    </script>

</body>
</html>