<?php

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    /*if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }*/

    $bdd = connect();

    $sql = "SELECT * FROM oeuvre";

    $sth = $bdd->prepare($sql);
        
    $sth->execute();

    $donjons = $sth->fetchAll();
?>
<style>

</style>

