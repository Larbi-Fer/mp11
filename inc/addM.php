<?php 

//if(isset($_POST['post'])) {
    // print_r($_POST);
    /*$url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => "6LfP2PgUAAAAAF49dJ5-TBRy0hwmZH25P6_xkppF",
        'response' => $_POST['token'],
        // 'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
        )
      );

    $context  = stream_context_create($options);
      $response = file_get_contents($url, false, $context);

    $res = json_decode($response, true);
    if($res['success'] == true) {*/
        require "coon.php";
/*
        $nom      = mysqli_real_escape_string($coon, $_POST["nom"]);
        $prenom   = mysqli_real_escape_string($coon,$_POST["prenom"]);
        $email    = mysqli_real_escape_string($coon,$_POST["email"]);
        $pseudo   = mysqli_real_escape_string($coon,$_POST["pseudo"]);
        $password = mysqli_real_escape_string($coon,$_POST["password"]);
        $prof     = mysqli_real_escape_string($coon,$_POST["prof"]);*/
        $error = "";
        $nom      =  $_POST["nom"];
        $prenom   = $_POST["prenom"];
        $email    = $_POST["email"];
        $pseudo   = $_POST["pseudo"];
        $password = $_POST["password"];
        $prof     = $_POST["prof"];

        if( empty($nom)  || empty($prenom) || empty($email) || empty($pseudo) || empty($password) ){
            $error = "<b style='color:red'>il y'a des champs vides</b>";
        }
        else{
            
            if( strlen( $pseudo ) < 4 ){
                $error = "<b style='color:red'> la pseudo doit contenir plus que 4 caracteres </b><br>";
            }
            /*if( !preg_match( '/*[a-zA-Z0-9]+$/',$pseudo ) ){
                $error = "<b style='color:red'> la pseudo doit contenir des chiffres et des letter seulement </b><br>";
            }*/
            if( is_numeric( $pseudo[0] ) ){
                $error .= "<b style='color:red'>le prof ne doit pas commencer par un chiffre</b><br>";
            }
            if( strlen( $password ) < 8 ){
                $error .= "<b style='color:red'> la mot pass doit contenir plus que 7 caracteres </b><br>";
            }
            if( !filter_var( $email,FILTER_VALIDATE_EMAIL ) ) {
                $error .= "<b style='color:red'> l'email est incorrecte </b></br>";
            }
            if( empty( $error ) ){

                $pass = password_hash( $password, PASSWORD_BCRYPT );

                $selectM = mysqli_query($coon,"SELECT userName,email FROM mombers WHERE userName='".$pseudo."' OR email='".$email."'") or die (mysqli_error($coon));
                $numM   = mysqli_num_rows($selectM);

                
                if( $numM == 0 ){
                    $insertM = mysqli_query( $coon, "INSERT INTO mombers(nom, prenome, email, userName, passwor, type) 
                        VALUES('$nom','$prenom','$email','$pseudo','$pass','$prof')
                        " ) or die (mysqli_error($coon));
                    if( $insertM ){
                        $error = "<b style='color:green'>Inscription complete</b></br>";
                    }
                    else{
                        $error = "<b style='color:green'>Inscription incomplete</b></br>";
                    }
                }
                else{
                    $error = "<b style='color:red'>ce pseudo existe/Cet email existe</b></br>";
                }

                
            }

        }

        
        
    /*}
    else {
        $error = "<b style='color:red'>Reca Incorect</b></br>";
    }*/
    echo $error;
//}
    

?>