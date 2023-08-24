<?php
$serveur = "mehdichekhab";
$utilisateur = "root";
$mdp = "";
$bdd = "formulaire"; // Remplacez par le nom de votre base de données

$conn = new mysqli($serveur, $utilisateur, $mdp, $bdd);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Fonction d'échappement personnalisée
function escape($value) {
    global $conn;
    return mysqli_real_escape_string($conn, $value);
}
?>
