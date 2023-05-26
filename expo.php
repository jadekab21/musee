<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require_once('_expo.php'); ?>
<?php require_once('barre2.php'); ?>


<h1>bienvenue dans l'expo du momemnt</h1>
<?php

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

   

    $bdd = connect();

    $sql = "SELECT * FROM categories";

    $sth = $bdd->prepare($sql);
        
    $sth->execute();

    $donjons = $sth->fetchAll();
?>
<style>

</style>
<?php require_once('_header.php'); ?>
    <div class="container">
        <ul class= "carte">
            <?php foreach($donjons as $donjon) { ?>
                
               <div> <li class="rectangle"><a href="expocat.php?id=<?php echo $donjon['id']; ?>">
             
                   <p  class="p" > <?php echo $donjon['name']; ?></p>
                </a></li></div>
            <?php } ?>
        </ul>
    </div>
</body>
</html>