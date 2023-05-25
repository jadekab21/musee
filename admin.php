<?php
// Connexion à la base de données
$host = "localhost";
$db_user = "nom_utilisateur";
$db_password = "mot_de_passe";
$db_name = "musee";
$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

// Récupérer la liste des utilisateurs en attente de validation
$query = "SELECT * FROM users WHERE active = 0";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Traitement de la validation des utilisateurs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["validate"])) {
    $userId = $_POST["validate"];
    $query = "UPDATE users SET active = 1 WHERE id = $userId";
    mysqli_query($conn, $query);
  } elseif (isset($_POST["delete"])) {
    $userId = $_POST["delete"];
    $query = "DELETE FROM utilisateurs WHERE id = $userId";
    mysqli_query($conn, $query);
  }
}

//
