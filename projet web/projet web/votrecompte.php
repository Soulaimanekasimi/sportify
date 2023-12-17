<?php
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');

if ($db_handle) {
    $db_found = mysqli_select_db($db_handle, $database);

    if ($db_found) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $utilisateur = "ID_Utilisateur"; // À modifier en fonction de votre base de données
    $motDePasse = "Mot_de_passe"; // À modifier en fonction de votre base de données
    
    $username = $_POST['username'];

    // Exemple de requête pour récupérer des informations du compte
    $sql = "SELECT * FROM users WHERE ID_Utilisateur ='$username'";
    $resultat = $db_handle->query($sql);

    if ($resultat) {
        if ($resultat->num_rows > 0) {
            while ($row = $resultat->fetch_assoc()) {
                echo "<p>" . $row["Nom"] . "</p>";
            }
        } else {
            echo "<p>Aucune information trouvée.</p>";
        }
    } else {
        echo "Erreur d'exécution de la requête : " . $db_handle->error;
    }

    
}

$db_handle->close(); // Fermer la connexion à la base de données
?>
