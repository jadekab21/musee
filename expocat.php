<?php
require_once('functions.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Vérifier si l'ID de catégorie est passé en paramètre
if (!isset($_GET['id'])) {
    header('Location: expo.php');
    exit();
}

// Établir la connexion à la base de données
$bdd = connect();

// Récupérer l'ID de catégorie depuis le paramètre GET
$categoryID = $_GET['id'];

// Requête pour récupérer les œuvres de la catégorie spécifiée
$sql = "SELECT * FROM oeuvre WHERE categories_id = :categoryID";
$sth = $bdd->prepare($sql);
$sth->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
$sth->execute();

// Récupérer toutes les œuvres de la catégorie
$oeuvres = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oeuvres de la catégorie</title>
    <style>
        /* Ajoutez ici votre CSS personnalisé */
    </style>
</head>
<body>
    <?php require_once('_expo.php'); ?>
    <?php require_once('barre2.php'); ?>
    
    <h1>Oeuvres de la catégorie</h1>
    
    <div class="container">
    <ul class="oeuvres-liste">
        <?php foreach($oeuvres as $oeuvre) { ?>
            <li class="oeuvre">
                <h2><?php echo $oeuvre['name']; ?></h2>
                <div class="oeuvre-img-container">
                    <img src="<?php echo $oeuvre['pic']; ?>" alt="Image de l'œuvre" data-description="<?php echo $oeuvre['description']; ?>" data-prix="<?php echo $oeuvre['prix']; ?>">
                </div>
                <form action="update_like.php" method="post">
    <input type="hidden" name="oeuvreID" value="<?php echo $oeuvre['id']; ?>">
    <button type="submit" name="like">Like</button>
</form>

                <!-- Ajoutez ici d'autres informations sur l'œuvre -->
            </li>
        <?php } ?>
    </ul>
</div>

<!-- Boîte modale -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="modal-img" src="" alt="Image de l'œuvre">
        <div class="modal-info">
            <h2 id="modal-title"></h2>
            <p id="modal-description"></p>
            <p id="modal-prix"></p>
        </div>
    </div>
</div>


</body>
</html>
<script>
    // Sélectionnez tous les éléments d'image
    var images = document.querySelectorAll('.oeuvre-img-container img');

    // Sélectionnez la boîte modale
    var modal = document.getElementById('modal');

    // Sélectionnez les éléments de la boîte modale
    var modalImg = document.getElementById('modal-img');
    var modalTitle = document.getElementById('modal-title');
    var modalDescription = document.getElementById('modal-description');
    var modalPrix = document.getElementById('modal-prix');
    var modalClose = document.getElementsByClassName('close')[0];

    // Parcourez chaque image et ajoutez les écouteurs d'événements
    images.forEach(function(image) {
        image.addEventListener('click', function() {
            // Récupérez les informations de description, de prix et l'URL de l'image
            var description = image.dataset.description;
            var prix = image.dataset.prix;
            var imgUrl = image.getAttribute('src');
            var imgAlt = image.getAttribute('alt');

            // Affichez les informations dans la boîte modale
            modalImg.src = imgUrl;
            modalImg.alt = imgAlt;
            modalTitle.textContent = imgAlt;
            modalDescription.textContent = description;
            modalPrix.textContent = 'Prix : ' + prix;

            // Ouvrez la boîte modale
            modal.style.display = 'block';
        });
    });

    // Fermez la boîte modale lorsque vous cliquez sur le bouton de fermeture
    modalClose.addEventListener('click', function() {
        modal.style.display = 'none';
    });
</script>
<style>
    /* Style de la boîte modale */
.modal {
    display: none; /* Par défaut, la boîte modale est masquée */
    position: fixed; /* Position fixe pour rester au-dessus du contenu */
    z-index: 999; /* Une valeur élevée pour s'assurer que la boîte modale est au-dessus des autres éléments */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Permet le défilement si le contenu dépasse la taille de la fenêtre */
    background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
}

/* Style de la boîte modale - contenu */
.modal-content {
    background-color: #fefefe;
    margin: auto; /* Centrez la boîte modale horizontalement et verticalement */
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    text-align: center;
    position: relative;
}

/* Style du bouton de fermeture */
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

/* Style de l'image de l'œuvre dans la boîte modale */
#modal-img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain; /* Ajuste l'image à l'intérieur du conteneur sans déformation */
    margin-bottom: 20px;
}

/* Style du titre, de la description et du prix dans la boîte modale */
#modal-title {
    font-size: 24px;
    margin-bottom: 10px;
}

#modal-description,
#modal-prix {
    margin-bottom: 10px;
}
</style>