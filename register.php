<?php require_once('_header.php');?>

<?php

    require_once('functions.php');
    if (isset($_POST["send"])){
        $bdd = connect ();

        $_statut= 'inactive';
        $role_id= 2;
        $sql= "INSERT INTO users (`email`, `password`,`name`,`prenom`,`adresse`,`code_postale`,`statut`,`role_id`) VALUES (:email, :password ,:name,:prenom,:adresse,:code_postale,:statut,:role_id);";
        $sth=$bdd->prepare($sql);
        $sth->execute([
            'email'=> $_POST['email'],
            'password'=>password_hash($_POST ['password'], PASSWORD_DEFAULT),
            'name'=> $_POST['name'],
            'prenom'=> $_POST['prenom'],
            'adresse'=> $_POST['adresse'],
            'code_postale'=> $_POST['code_postale'],
            'statut'=> $_statut,
            'role_id'=>$role_id

        ]);

        header('Location: login.php');
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
       height: 200;
       border-radius: 30px;

    }
    
    input, select, textarea {
        border: 1px solid gray;
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 30px;
    }
    body {
            background-image: url(img/museecreer.jpg);
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
    <h1>Créer votre compte</h1>

        <div>
            <label for="email">Email</label>
            <input type="email" placeholder="Entrez votre email" name="email" id="email">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" placeholder="Entrez votre mot de passe" name="password" id="password">
        </div>
        <div>
            <label for="name">nom</label>
            <input type="name" placeholder="Entrez votre nom" name="name" id="name">
        </div>
        <div>
            <label for="prenom">prenom</label>
            <input type="prenom" placeholder="Entrez votre prenom" name="prenom" id="prenom">
        </div>
        <div>
            <label for="adresse">adresse</label>
            <input type="adresse" placeholder="Entrez votre adresse" name="adresse" id="adresse">
        </div>
        <div>
            <label for="code_postale">code postale</label>
            <input type="code_postale" placeholder="Entrez votre code_postale" name="code_postale" id="code_postale">
        </div>
        <div>
        <input type="submit"  name="send" value="Créer" />
        </div>
    </form>
    <style>
       /* body {
            background-image: url(img/assassins-creed-odyssey.jpg);
            background-size: cover;
        }*/
    </style>
</body>
</html>
<?php
