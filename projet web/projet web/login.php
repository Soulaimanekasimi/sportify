<?php
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');

if ($db_handle) {
    $db_found = mysqli_select_db($db_handle, $database);

    if ($db_found) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to check if the credentials are valid
$sql = "SELECT * FROM users WHERE ID_Utilisateur = '$username' AND Mot_de_passe = '$password'";
$result = $db_handle->query($sql);


if ($result->num_rows > 0) {
    // Valid credentials, redirect to the desired page
    header("Location: sportifylogin.html");
    exit();
} else {
    // Invalid credentials, redirect back to the login page with an error message
    header("Location: login.html?error=1");
    exit();
}
}}}
// Close the database connection
$conn->close();
?>