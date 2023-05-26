

<?php require_once('barre.php'); ?> 
<?

$host = "localhost";
$db_user = "nom_utilisateur";
$db_password = "mot_de_passe";
$db_name = "musee";
$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login2.php");
  exit();
}
$sql = "SELECT * FROM users WHERE statut = 'inactive'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userId = $row['id'];
        $userName = $row['nom'];
        $userEmail = $row['email'];
        // Affichez les informations de l'utilisateur et un bouton pour valider le compte
        echo "Utilisateur : $userName ($userEmail) <button onclick='validerCompte($userId)'>Valider</button><br>";
    }
} else {
    echo "Aucun utilisateur en attente de validation.";
}
function validerCompte($userId) {
  // Effectuez une requête de mise à jour pour marquer le compte comme "activé"
  $sql = "UPDATE users SET statut= 'activé' WHERE id = $userId";
  // Exécutez la requête de mise à jour et gérez les erreurs si nécessaire
  // ...
} !>