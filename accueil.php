
<?php require_once('functions.php');
  


    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    $bdd = connect();

    $sql = "SELECT * FROM oeuvre WHERE user_id = :user_id";

    $sth = $bdd->prepare($sql);
        
    $sth->execute([
        'user_id'     => $_SESSION['user']['id']
    ]);

    $persos = $sth->fetchAll();

    // dd($persos);

?>
<?php require_once('_header.php');
require_once('barre.php'); ?>


<h1>Bienvenue au musee sensoriel</h1>



<div class="rectangle"> <h4>a propos de nous</h4></div>



