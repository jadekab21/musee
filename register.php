<?php

    require_once('functions.php');
    if (isset($_POST["send"])){
        $bdd = connect ();

        $sql= "INSERT INTO users (`email`, `password`) VALUES (:email, :password);";
        $sth=$bdd->prepare($sql);
        $sth->execute([
            'email'=> $_POST['email'],
            'password'=>password_hash($_POST ['password'], PASSWORD_DEFAULT)
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
        height: 100vh;
      border: 1px solid black;
      padding: 20px;
      text-align: center;
    font-size: 18px;
      position: absolute; 
      top: 50%; 
      left: 50%;
       transform: translate(-50%, -50%);
       height: 250;
       border-radius: 30px;

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

