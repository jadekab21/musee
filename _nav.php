<ul id="nav"> 
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a href="logout.php"> Logout</a></li>
        <li><a href="avatars.php"> avatar</a></li>
    
        
        <?php if (isset($_SESSION['user']['avatar_id'])) {
            $avatarId = $_SESSION['user']['avatar_id'];

            $bdd = connect();
            $query = "SELECT pic FROM avatars WHERE id_avatar = :avatarId";
            $statement = $bdd->prepare($query);
            $statement->execute(['avatarId' => $avatarId]);
            $row = $statement->fetch();

            if ($row) {
                $avatarPic = $row['pic'];
                echo '<li><img src="' . $avatarPic . '" alt="Avatar" class="avatar-image-small"></li>';
            }
        }?>
    <?php } ?>
</ul>
<style>
    .avatar-image-small {
    width: 30px;
    height: 30px;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-image-circle {
    border-radius: 50%;
}
</style>