<?php
session_start();
if( !isset( $_SESSION["username"] ) ){
    header("Location:login.php");
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["username"]; ?> Page</title>
    <!--<link rel="stylesheet" href="css/bootstrap.css">-->
    <link rel="stylesheet" href="MP11/cssFile.css">
    
    <link rel="stylesheet" href="inc/cssFileNav.css">
</head>
<body>

<?php $activ = 1; require "inc/navbar.php" ?>

<h1><?php echo $_SESSION["username"]; ?></h1>

</body>
</html>