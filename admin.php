<a class="btn btn-grey" href="acceuil2.php">Retour</a><?php

//$host = "localhost";
//$db_user = "nom_utilisateur";
/*$db_password = "mot_de_passe";
$db_name = "musee";
$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
session_start();*/


$bdd = connect();

$sql = "SELECT * FROM users WHERE statut='inactive'";

$sth = $bdd->prepare($sql);

$persos = $sth->fetchAll();

$result = $conn->query($sql);
?>

<tr>
    <td>id</td>
    <td>email</td>
    <td>Nom</td>
    <td>adresse</td>
            </tr>  

            <tr>
                    <td><?php echo $users['id']; ?></td>
                    <td><?php echo $users['email']; ?></td>
                    <td><?php echo $users['mail']; ?></td>
                    <td><?php echo $users['adresse']; ?></td>
                    <td>

                    $result = $conn->query($sql);

<!--if ($result->num_rows > 0) {
    echo "<h1>Utilisateurs à valider :</h1>";
    while ($row = $result->fetch_assoc()) {
        $userId = $row['id'];
        $userName = $row['nom'];
        $userEmail = $row['email'];
        // Affichez les informations de l'utilisateur
        echo "<p>Nom : $userName<br>Email : $userEmail</p>";
    }
} else {
    echo "Aucun utilisateur à valider.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>