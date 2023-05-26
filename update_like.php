<?php
require_once('functions.php');

// Vérifier si l'ID de l'œuvre a été soumis
if (isset($_POST['oeuvreID'])) {
    // Établir la connexion à la base de données
    $bdd = connect();

    // Récupérer l'ID de l'œuvre
    $oeuvreID = $_POST['oeuvreID'];

    // Effectuer la mise à jour dans la base de données
    $sql = "UPDATE oeuvre SET `like` = `like` + 1 WHERE id = :oeuvreID";

    $sth = $bdd->prepare($sql);
    $sth->bindParam(':oeuvreID', $oeuvreID, PDO::PARAM_INT);
    $sth->execute();

    // Rediriger vers la page précédente ou afficher un message de confirmation, selon vos besoins
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>