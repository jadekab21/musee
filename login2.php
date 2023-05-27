<?php

    require_once('functions.php');
    if (isset($_POST["send"])){
        $bdd = connect ();
        //dd($_POST);

        $sql= "SELECT * FROM users WHERE `email` = :email;";

        $sth=$bdd->prepare($sql);
        $sth->execute([
            'email'     => $_POST['email']
        ]);

        $user = $sth->fetch();
        //var_dump ($user);
        print($user[8]);
    
        
        if ($user && password_verify($_POST['password'], $user['password']) ){
           // dd($user);
           if ($user[8]=='active' && $user[9]==1){
            $_SESSION['user'] = $user;
           header('Location: accueil2.php');
           } else{
            $msg = "Utilisateurs non admin!";
           }
        } else{
            $msg = "Email ou mot de passe incorrect !";
        }
        //header('Location: accueil.php');
    }

?>
<style>
     form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 50vh;
      border: 1px solid black;
      padding: 20px;
      background: rgba(255,255,255, 0.5);
      text-align: center;
    font-size: 18px;
      position: absolute; 
      top: 50%; 
      left: 50%;
       transform: translate(-50%, -50%);
       height: 250;
       border-radius: 30px;

    }
    
    input, select, textarea {
        border: 1px solid gray;
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 30px;
    }
     body {
            background-image: url(img/image.jpg);
            background-size: cover;
            
        }
  
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
    <form action="" method="post">
        <h1>Espace administrateur</h1>

        <?php
            if (isset($msg)) {
                echo "<div>" . $msg . "</div>";
            } ?>
        <div>
            <label for="email">Email</label>
            <input type="email" placeholder="Entrez votre email" name="email" id="email">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" placeholder="Entrez votre mot de passe" name="password" id="password">
        </div>
        <div>
        <input type="submit" name="send" value="Connexion" />
        </div>
    </form>

    <style>
       
    </style>
    
</body>
</html>


