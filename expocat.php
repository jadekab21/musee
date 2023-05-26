<?php

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }



    $bdd = connect();

    $sql= "SELECT * FROM `oeuvre` WHERE categories_id = :categories_id ORDER BY RAND() LIMIT 1;";

    $sth = $bdd->prepare($sql);

    $sth->execute([
        'categories_id' => $_GET['id']
    ]);

    $room = $sth->fetch();

    /*require_once('./classes/Room.php');
    $roomObject = new Room($room);
    $roomObject->makeAction();*/
?>
<style>
   /* body {
        background-image: url(img/ ?>);
        background-size: cover;
        background-position: center;
        
    }*/
</style>

<?php require_once('_header.php'); ?>
    <div 
        class="container"
        style="background-color: rgba(255,255,255, 0.4)"
        
    >
        <div class="row mt-4">
            <div class="px-4">
                
            </div>
            <div class="">
                <h1><?php echo $oeuvreObject->getName(); ?></h1>
                <p><?php echo $oeuvreObject->getDescription(); ?></p>
            
            </div>
        </div>
    </div>
    </body>
</html>