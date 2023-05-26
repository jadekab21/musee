<?php
require_once('_header.php');
require_once('_nav.php');
require_once('functions.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$bdd = connect();

$sql = "SELECT * FROM users WHERE id = :user_id";

$sth = $bdd->prepare($sql);

$sth->execute([
    'user_id' => $_SESSION['user']['id']
]);

$row = $sth->fetch(PDO::FETCH_ASSOC);
if ($row) {
$email = $row['email'];

$name = $row['name'];
$prenom = $row['prenom'];
$adresse = $row['adresse'];
$code_postale = $row['code_postale'];
} else {
 
    // Gérer le cas où la requête ne renvoie aucun résultat
    // Par exemple, rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur approprié.
    echo "Erreur : Impossible de récupérer les données de l'utilisateur.";
    exit();
}
if (isset($_POST['delete_account'])) {
    $user_id = $_SESSION['user']['id'];
    $query = "DELETE FROM users WHERE id = :user_id";
    $statement = $bdd->prepare($query);
    $statement->execute(['user_id' => $user_id]);
    session_destroy();
    header("Location: index.php");
    exit();
}



if (isset($_POST['update_info'])) {
    $user_id = $_SESSION['user']['id'];
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $code_postale = $_POST['code_postale'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifiez si le champ du mot de passe est vide
    if (!empty($password)) {
        // Hash du nouveau mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Mettez à jour le mot de passe dans la base de données
        $query = "UPDATE users SET password = :password WHERE id = :user_id";
        $statement = $bdd->prepare($query);
        $statement->execute([
            'password' => $hashedPassword,
            'user_id' => $user_id
        ]);
    }

    // Mettez à jour les autres champs d'information de l'utilisateur
    $query = "UPDATE users SET name = :name, prenom = :prenom, email = :email, adresse = :adresse, code_postale = :code_postale WHERE id = :user_id";
    $statement = $bdd->prepare($query);
    $statement->execute([
        'name' => $name,
        'prenom' => $prenom,
        'email' => $email,
        'adresse' => $adresse,
        'code_postale' => $code_postale,
        'user_id' => $user_id
    ]);

    header("Location: account.php");
    exit();
}


// Récupérez l'ID de l'utilisateur connecté
$userId = $_SESSION['user']['id'];

// Récupérez l'avatar sélectionné par l'utilisateur depuis la base de données
$query = "SELECT avatar_id FROM users WHERE id = :userId";
$statement = $bdd->prepare($query);
$statement->execute(['userId' => $userId]);
$result = $statement->fetch();

$selectedAvatarId = $result['avatar_id'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
       
        <form action="" method="post">
        <div class="form-group">
                <label for="email">email:</label>
                <input type="text" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
    <label for="password">password:</label>
    <input type="password" name="password" value="" required>
</div>

            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" value="<?php echo $prenom; ?>" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <input type="text" name="adresse" value="<?php echo $adresse; ?>" required>
            </div>
            <div class="form-group">
                <label for="code_postale">Code postal:</label>
                <input type="text" name="code_postale" value="<?php echo $code_postale; ?>" required>
            </div>
            <div>
                <input type="submit" class="btn btn-blue" name="update_info" value="Mettre à jour les informations" />
            </div>
            
        </form>
   
    <div class="avatar">
                <h2>Mon avatar</h2>
                <?php
                if ($selectedAvatarId) {
                    // Affichez l'avatar sélectionné
                    $query = "SELECT name, pic FROM avatars WHERE id_avatar = :selectedAvatarId";
                    $statement = $bdd->prepare($query);
                    $statement->execute(['selectedAvatarId' => $selectedAvatarId]);
                    $result = $statement->fetch();

                    $nameAvatar = $result['name'];
                    $picAvatar = $result['pic'];

                    echo '<div class="avatar-container">';
                    echo '<img src="' . $picAvatar . '" alt="' . $nameAvatar . '" class="avatar-image">';
                    echo '</div>';
                } else {
                    // Affichez un message si aucun avatar n'a été sélectionné
                    echo 'Aucun avatar sélectionné.';
                }
                ?>

                <br>
                <a href="avatars.php">Changer d'avatar</a>
                <a href="accueil.php" class="btn btn-blue btn-link">quitter</a>

            </div>
            
            </div>
</body>

</html>

<style>
    .btn-link {
        position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #b79726;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: 0.5s;
    margin-top: 40px;
    letter-spacing: 4px;
    background: transparent;
    border: 1px solid #b79726;
    cursor: pointer;
}

.btn-link:hover {
    background: #f49803;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px #f4c803, 0 0 25px #bd9d0b, 0 0 50px #f4e403, 0 0 100px #d5cf1e;
}

    .container {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
    .container h1 {
        margin-bottom: 10px;
        color: orange;
    }

    .form-container {
        width: 50%;
        margin-right: 20px;
        margin: 0; 
    }
    .form-group label {
    grid-column: 1;
    grid-row: 1;
    padding-bottom: 7px; /* Ajoute de l'espace en bas du label */
}

.form-group input {
    grid-column: 2;
    grid-row: 1;
    padding-top: 27px; /* Ajoute de l'espace en haut du champ de saisie */
}


    form {
    width: 600px;
    margin: 0 auto;
    
    padding: 20px;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form h1 {
    color: #fff;
    text-align: center;
    margin-bottom: 30px;
}

form div {
    position: relative;
    margin-bottom: 30px;
}

form div label {
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px 0;
    font-size: 16px;
    color: #f6900a;
    pointer-events: none;
    transition: 0.5s;
}

form div input {
    width: 100%;
    padding: 10px 0;
    font-size: 16px;
    color: #fff;
    margin-bottom: 10px;
    border: none;
    border-bottom: 1px solid #fff;
    outline: none;
    background: transparent;
}

form div input:focus ~ label,
form div input:valid ~ label {
    top: -20px;
    left: 0;
    color: #f68e44;
    font-size: 12px;
}

form div:last-child {
    margin-bottom: 0;
}

form input[type="submit"] {
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #b79726;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: 0.5s;
    margin-top: 40px;
    letter-spacing: 4px;
    background: transparent;
    border: 1px solid #b79726;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background: #f49803;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px #f4c803, 0 0 25px #bd9d0b, 0 0 50px #f4e403, 0 0 100px #d5cf1e;
}
.avatar {
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .avatar h2 {
        margin-bottom: 10px;
        color: orange;
    }
    .avatar a {
        color: orange;
    }
    form {
        width: 100%;
    }
    .avatar-container {
    position: relative;
    width: 100px; /* Ajustez la taille selon vos besoins */
    height: 100px; /* Ajustez la taille selon vos besoins */
}

.avatar-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-position {
    position: absolute;
    bottom: 0;
    right: 0;
}

</style>