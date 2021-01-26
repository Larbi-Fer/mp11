
<link rel="stylesheet" href="inc/cssFileNav.css">

<nav>
    <input type="checkbox" class="check" id="check">
    <label for="check">
        <li><img src="img/R3.png" alt="القائمة" class="checkbtn"></li>
    </label>
    <label for="" class="logo">MP11</label>
    <ul>
    <?php
    if( !isset( $_SESSION["username"] ) ){?>
        <li><a href="index.php" <?php if($activ == 1) { echo "class='activ'"; } ?>>Home</a></li>
        <li><a href="register.php" <?php if($activ == 2) { echo "class='activ'"; } ?>>Inscriptionme</a></li>
        <li><a href="login.php" <?php if($activ == 3) { echo "class='activ'"; } ?>>Login</a></li>
    <?php }else { ?>
        <li><a href="Profile.php" <?php if($activ == 1) { echo "class='activ'"; } ?>>Profile</a></li>
        <li><a href="Logout.php"<?php if($activ == 2) { echo "class='activ'"; } ?>>Logout</a></li>
    <?php } ?>
    
        
    </ul>
</nav>
