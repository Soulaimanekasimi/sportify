<?php
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');

if ($db_handle) {
    $db_found = mysqli_select_db($db_handle, $database);

    if ($db_found) {

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $coachId = $_POST["coachId"];
            $selectedDay = $_POST["selectedday"];

            // Validate coach availability (modify as needed)
            
            $sql = "SELECT * FROM coachs WHERE ID_Coach = '$coachId' AND Disponibilite_Semaine = '$selectedDay'";
            $result = $db_handle->query($sql);

            if ($result->num_rows > 0) {
                // Update the database (modify as needed)
                $updateSql = "UPDATE coachs SET Disponibilite_Semaine = 'NULL' WHERE ID_Coach = '$coachId' AND Disponibilite_Semaine = '$selectedDay'";
                $db_handle->query($updateSql);

                echo "Rendez-vous confirmé avec $coachId le $selectedDay";
            } else {
                echo "Créneau non disponible. Veuillez choisir un créneau valide.";
            }
        }
    }

    // Close the database connection
    mysqli_close($db_handle);
}
?>
