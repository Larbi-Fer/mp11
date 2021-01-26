<?php
session_start();
if( isset( $_SESSION["username"] ) ){
    header("Location:profile.php");
}
//galaxyProgram
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!--<link rel="stylesheet" href="css/bootstrap.css">-->
    
    <link rel="stylesheet" href="cssFile.css">
    
    <link rel="stylesheet" href="inc/cssFileNav.css">
</head>
<body>

<?php $activ = 3; require "inc/navbar.php" ?>


    <!--<?php require "inc/navbar.php" ?>-->
    <div class="form-box" id="form-box">
        <div id="register" class="input-group">
            
                <label for="pseudo" class="lbl">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" class="input-field"  placeholder="Enter vote pseudo" required>

                <label for="" class="lbl">Password</label>
                <input type="password" name="password" id="password" class="input-field"  placeholder="Password" required>
                <!--<input type="checkbox" class="check-box"><span>I agree to the terms and condition</span>-->

                
                    
                    <div class="info alert alert-primary" role="alert">
                        
                    </div>
                    
                
                <button type="submit" id="submit" name="submit" class="submit-btn" style="margin-top: 20px;">Entre</button>
            
               <a href="reset.php">نسيت كلمة المرور</a> 
        </div>
    </div>
    <script src="js/JQ.js"></script>
    <script>

        $(document).ready(function(){

            $('.info').css('display', 'none');

            $('#submit').on( 'click', function() {
                
                var pseudo   = $('#pseudo').val();
                var password = $('#password').val();

                if( pseudo == '' || password == '' ){
                    alert("il y'a des champs vides");
                }
                else{
                    $.ajax({
                        url: 'inc/LoginM.php',
                        method: 'post',
                        data:{pseudo:pseudo,password:password},
                        success:function(data){
                            if( data == "ok" ){
                                $('.info').css('display', 'block');
                                $('.info').html(data);
                                //window.location.href = 'profile.php';
                                setTimeout(() => {
                                    window.location.href = 'profile.php';
                                }, 2000);
                            }
                            else{
                                $('.info').css('display', 'block');
                                $('.info').html(data);
                            }
                        }
                    });
                }

            } );

        });



        

    </script>
</body>
</html>