<?php

if( isset( $_GET["email"] ) && isset( $_GET["token"] ) ){

    require_once("inc/coon.php");
    $error = '';
    $email = mysqli_real_escape_string($coon,$_GET["email"]);
    $token = mysqli_real_escape_string($coon,$_GET["token"]);
    $verifyTokenEmail = mysqli_query($coon,"SELECT * FROM mombers 
        WHERE email='".$email."'
        AND token='".$token."' 
        AND tokenDate > DATE_SUB(NOW(),INTERVAL 30 MINUTE)")
        or die( mysqli_error($coon) );
    $count = mysqli_num_rows($verifyTokenEmail);
    if( $count == 1 ){
        if( isset( $_POST["change"] ) ){
            $password = mysqli_real_escape_string($coon,$_POST["pswd"]);
            $cpassword = mysqli_real_escape_string($coon,$_POST["cpswd"]);
            if( ( empty($password) || empty($cpassword) ) || ($password != $cpassword) ){
                $error = "<b style='color:red'> les champs vides / mot passe non identique </b><br>";
            }
            if( strlen( $password ) < 8 ){
                $error .= "<b style='color:red'> la mot pass doit contenir plus que 7 caracteres </b><br>";
            }
            if( empty($error) ){
                $pass = password_hash( $password, PASSWORD_BCRYPT );
                $updatePass = mysqli_query($coon,"UPDATE mombers
                    SET passwor='".$pass."'
                        WHERE email='".$email."' ") or die(mysqli_error($coon));
                    if( $updatePass ){
                        $updateTok = mysqli_query($coon,"UPDATE mombers
                            SET token=NULL WHERE email='".$email."' ") or die(mysqli_error($coon));
                        if( $updateTok ){
                            $error = "ok";
                        }
                        else{
                            $error = "error";
                        }
                    }
                    else{
                        $error = "Probleme de changement du mot de passe";
                    }
            }
        }
    }
    else{
        header("Location:login.php");
    }


}
else{
    header("Location:login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer Votre mot de passe</title>
    <link rel="stylesheet" href="cssFile.css">
</head>
<body>
    <?php $activ=0; require_once("inc/navbar.php"); ?>
    <form action="" method="post">
        <div class="form-box">
            <div class="input-group">

                <label for="nom" class="lbl">Nouveau Mot do passe</label>
                <input type="password" id="nom" name="pswd" class="input-field" placeholder="Enter vote Nouveau Mot do passe" required>

                <label for="nom" class="lbl">confirmation</label>
                <input type="password" id="nom" name="cpswd" class="input-field" placeholder="confirmation" required>

                <?php if( $error != "" ){ ?>
                <div class="info alert alert-primary" role="alert">
                    <?php echo $error ?>
                </div>
                <?php } ?> 

                <button type="submit" name="change" class="submit-btn">chenger lu mot de passe</button>

            </div>
        </div>
    </form>
</body>
</html>