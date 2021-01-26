<?php

use function PHPSTORM_META\type;

session_start();

    require "coon.php";

    
    $pseudo   = mysqli_real_escape_string($coon, $_POST["pseudo"]);
    $password = mysqli_real_escape_string($coon,$_POST["password"]);
    $error;

    if( empty($pseudo) || empty($password) ){
        $error = "<b style='color:red'>il y'a des champs vides</b>";
    }
    else{
        
        $selectM = mysqli_query($coon,"SELECT * FROM mombers WHERE userName='".$pseudo."'") or die (mysqli_error($coon));
        $numM    = mysqli_num_rows($selectM);
        $fetchM  = mysqli_fetch_assoc($selectM);
        @$pass    = $fetchM["passwor"];

        /*$selectM = $coon->prepare(query:"SELECT * FROM mombers WHERE userName= ?");
        $selectM->bind_param(type("s"), &var1: $pseudo);
        $selectM->bind_param(types:"s", &var1: $pseudo);
        $selectM->execute();
        $reselt = $selectM->get_result();
        $fetchM = $reselt->fetch_assoc();
        $pass    = $fetchM["passwor"];*/
        if( $numM == 1 ){
        //if( $reselt->num_rows === 1 ){
            
            if( password_verify( $password,$pass ) ){
                $_SESSION["username"] = $fetchM["userName"];
                $_SESSION["id"] = $fetchM["mid"];
                $error = "<b style='color:green '>ok</b></br>";
                //$_SESSION["username"] = $pseudo;
            }
            else{
                $error = "<b style='color:red'> mot de pass incorrects </b></br>";
            }
        }
        else{
            $error = "<b style='color:red'> le pseudo est incorrects </b></br>";
        }

            
        

    }

    echo $error;

?>