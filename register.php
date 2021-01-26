<?php
session_start();
if( isset( $_SESSION["username"] ) ){
    header("Location:profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!--<link rel="stylesheet" href="css/bootstrap.css">-->
    <link rel="stylesheet" href="cssFile.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LfP2PgUAAAAADQpZluDrw78Hc4j3qxj58WxHIiL"></script>
    <link rel="stylesheet" href="inc/cssFileNav.css">
</head>
<body>
<!--
    <nav>
        <input type="checkbox" class="check" id="check">
        <label for="check">
            <li><img src="img/R3.png" alt="القائمة" class="checkbtn"></li>
        </label>
        <label for="" class="logo">MP11</label>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php" class="activ">Inscriptionme</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>-->
    <?php $activ = 2; require "inc/navbar.php" ?>
    <div class="form-box" id="form-box">
        <div id="register" class="input-group">
            
                <label for="nom" class="lbl">Nom</label>
                <input type="text" id="nom" name="nom" class="input-field" placeholder="Enter vote nom" required>

                <label for="prenom" class="lbl">Prenom</label>
                <input type="text" name="prenom" id="prenom" class="input-field"  placeholder="Enter vote prenom" required>

                <label for="Email" class="lbl">Email</label>
                <input type="email" id="Email" name="email" class="input-field"  placeholder="Enter vote email" required>

                <label for="pseudo" class="lbl">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" class="input-field"  placeholder="Enter vote pseudo" required>

                <label for="" class="lbl">Password</label>
                <input type="password" name="password" id="password" class="input-field"  placeholder="Password" required>
                <!--<input type="checkbox" class="check-box"><span>I agree to the terms and condition</span>-->

                <input type="hidden" id="token" name="token">

                <div style="margin-top: 10px;">
                    <label for="" class="lbl">Choisir :</label>
                    <select name="prof" id="prof" class="input-field">
                        <option value="1">Prof</option>
                        <option value="2">etudiant</option>
                    </select>
                </div>
                     
                    <div class="info alert alert-primary">

                    </div>
                    
                
                <button type="submit" id="submit" name="submit" class="submit-btn" style="margin-top: 20px;">Inscir</button>
            
                
        </div>
    </div>
    <script src="js/JQ.js"></script>
    <script src="js/notify.js"></script>
    <script>

        $(document).ready(function(){

            $('.info').css('display', 'none');

            $('#submit').on( 'click', function() {
                
                var nom      = $('#nom').val();
                var prenom   = $('#prenom').val();
                var Email    = $('#Email').val();
                var pseudo   = $('#pseudo').val();
                var password = $('#password').val();
                var prof     = $('#prof').val();
                var token     = $('#token').val();

                if( nom == '' || prenom == '' || Email == '' || pseudo == '' || password == '' ){
                    alert("il y'a des champs vides")
                }
                else{
                    $.ajax({
                        url: 'inc/addM.php',
                        method: 'post',
                        data:{nom:nom,prenom:prenom,email:Email,pseudo:pseudo,password:password,prof:prof,token:token},
                        success:function(data){
                            $('.info').css('display', 'block');
                            //$.notify(date,"info");
                            $('.info').html(data);
                        }
                    });
                }

            } );

        });


        grecaptcha.ready(function() {
        grecaptcha.execute('6LfP2PgUAAAAADQpZluDrw78Hc4j3qxj58WxHIiL', {action: 'homepage'}).then(function(token) {
         // console.log(token);
         document.getElementById("token").value = token;
      });
  });

    </script>
</body>
</html>