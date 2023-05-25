<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
   <ul>
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="eboutique">E-Boutique</a></li>
   </ul>
    </nav>
</body>
</html>
<style>
    .navbar{
     display: flex;
     justify-content: space-between;
     background-color: black;
     color: white;
}


.navbar ul {
    display: flex;
    align-items: center;
    list-style-type: none;
    text-align:center;
}

.navbar ul li {
    display: inline-block;
    margin: 1px;
}

.navbar ul li a{
    padding: 2px;
    margin: 1px;
    color:white;
    margin-left:150px;
}

.navbar ul li a:hover{
    color:black;
    background-color: rgb(217, 136, 128);
    border-radius:4px
}
</style>