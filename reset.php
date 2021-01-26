<?php
session_start();
require_once "inc/coon.php";
//echo bin2hex(random_bytes(60));
if( isset( $_SESSION["username"] ) ){
    header("Location:profile.php");
}
if( isset( $_POST["send"] ) ){

    $error = '';
    $email = mysqli_real_escape_string($coon,$_POST["email"]);
    $varfiyEmail = mysqli_query($coon, "SELECT email FROM mombers WHERE email='".$email."'") or die(mysqli_error($coon));
    $count = mysqli_num_rows($varfiyEmail);
    if( $count == 1 ){
        $token = bin2hex(random_bytes(60));
        $updateTok = mysqli_query($coon,"UPDATE mombers SET token='".$token ."',
            tokenDate=NOW() WHERE email='".$email."'")
            or die( mysqli_error($coon) );
        if( $updateTok ){
            $to = "$email";
            $subject = "Reset Password";
            $txt = "Reset Password\n\nhttp://localhost/mp11/forget.php?email=".$email."&token=".$token."";
            $headers = "From:admin@galaxyprog.com";
            $send = mail($to,$subject,$txt,$headers);
            if( $send ){
                $error = " verifler votre boite email";
            }
        }
    }
    else{
        $error = "pas d'email ...";
    }    

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Page</title>
    <!--<link rel="stylesheet" href="css/bootstrap.css">-->
    <link rel="stylesheet" href="cssFile.css">

    <link rel="stylesheet" href="inc/cssFileNav.css">
    <style>
        <?php //require_once "inc/cssFileNav.css"; ?>
    </style>
</head>
<body>

    <?php $activ=0; require_once("inc/navbar.php"); ?>
<div class="form-box container">
    
    <div class="input-group">
        <form action="" method="post">
        <h1>Reset.php</h1>
                <label for="email" class="lbl">Email</label>
                <input type="email" name="email" class="input-field" placeholder="Enter votre email">
                
                <?php if( isset( ($error) ) ){ ?>
                <div class="info alert alert-primary" role="alert">
                    <?php echo $error ?>
                </div>
                <?php } ?>    
                <button type="submit" name="send" class="submit-btn">Envoyer</button>
            
        </form>
    </div>
</div>


</body>
</html>