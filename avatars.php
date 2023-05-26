<?php
require_once('functions.php');
require_once('_header.php');
require_once('_nav.php');

if (isset($_POST['submit'])) {
    // Récupérez l'ID de l'avatar sélectionné depuis le formulaire
    $avatarId = $_POST['avatar'];

    // Mettez à jour l'avatar sélectionné dans la table "users"
    $userId = $_SESSION['user']['id'];
    $bdd = connect();
    $query = "UPDATE users SET avatar_id = :avatarId WHERE id = :userId";
    $statement = $bdd->prepare($query);
    $statement->execute([
        'avatarId' => $avatarId,
        'userId' => $userId
    ]);
// Stockez l'ID de l'avatar sélectionné dans la session de l'utilisateur
$_SESSION['user']['avatar_id'] = $avatarId;

    // Redirigez l'utilisateur vers la page "account.php" après la sélection de l'avatar
    header('Location: account.php');
    exit();
}

?>

<style>
    .avatar-container {
        width: 100%;
        height: 300px; /* Ajustez la hauteur selon vos besoins */
        overflow-x: auto;
        overflow-y: hidden;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: nowrap;
    }

    .avatar-container label {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px;
    }

    .avatar-container img {
        width: 300px; /* Ajustez la taille selon vos besoins */
        height: 300px; /* Ajustez la taille selon vos besoins */
        object-fit: cover;
        border-radius: 100%;
    }
</style>

<form action="avatars.php" method="post">
    <h2>Choisir un avatar</h2>
    <div class="avatar-container">
        <?php
        $bdd = connect();
        $query = "SELECT id_avatar, name, pic FROM avatars";
        $result = $bdd->query($query);

        while ($row = $result->fetch()) {
            $idAvatar = $row['id_avatar'];
            $nameAvatar = $row['name'];
            $picAvatar = $row['pic'];

            echo '<label>';
            echo '<input type="radio" name="avatar" value="' . $idAvatar . '">';
            echo '<img src="' . $picAvatar . '" alt="' . $nameAvatar . '">';
            echo '</label>';
        }
        
        ?>
    </div>
    <br>
    <input type="submit" name="submit" value="Valider">
    
</form>
<style>
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
    display: flex;
    text-align: center;
        justify-content: center;
        margin-top: 20px;
        width: 200px;
}

form input[type="submit"]:hover {
    background: #f49803;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px #f4c803, 0 0 25px #bd9d0b, 0 0 50px #f4e403, 0 0 100px #d5cf1e;
    width: 220px; 
    margin-top: 20px;
}
</style>