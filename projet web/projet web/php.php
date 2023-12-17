<?php
// Étape 1: Établir une connexion à la base de données (à remplacer par tes propres informations)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nom_de_la_base_de_données";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// Étape 2: Récupérer les données de disponibilité du coach depuis la base de données
function isCoachAvailable($coachName, $selectedDay, $selectedTime, $conn) {
    $sql = "SELECT * FROM disponibilites_coach WHERE nom_coach = '$coachName' AND jour = '$selectedDay' AND disponibilite = '$selectedTime'";
    $result = $conn->query($sql);

    return $result->num_rows > 0; // Si des lignes sont renvoyées, le coach est disponible.
}

// Étape 3: Mettre à jour la base de données après la planification du rendez-vous
function updateCoachAvailability($coachName, $selectedDay, $selectedTime, $conn) {
    $sql = "UPDATE disponibilites_coach SET disponibilite = 'Occupé' WHERE nom_coach = '$coachName' AND jour = '$selectedDay' AND disponibilite = '$selectedTime'";
    $conn->query($sql);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $coachName = $_POST["coachName"];
    $selectedDay = $_POST["selectedDay"];
    $selectedTime = $_POST["selectedTime"];

    // Vérifier si le coach est disponible
    if (isCoachAvailable($coachName, $selectedDay, $selectedTime, $conn)) {
        // Mettre à jour la base de données
        updateCoachAvailability($coachName, $selectedDay, $selectedTime, $conn);
        echo "Rendez-vous confirmé avec $coachName le $selectedDay à $selectedTime";
    } else {
        echo "Créneau non disponible. Veuillez choisir un créneau valide.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
