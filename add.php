<?php
session_start();
if( !isset( $_SESSION["username"] ) ){
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
    <link rel="stylesheet" href="br/css/bootstrap.css">
    <style>
        /*.row{
            height: 100%;
            background-color: aqua;
            display: inline;/*margin-left: 7%;
        }
        .col{
            width: 47%;
            margin-left: 7%;
            
        }*/
        .col{
            width: 50% !important;
        }
        h3{
            margin-top: 10px;
        }
        tbody tr{
            transition: all .2s ease-in-out;
            cursor: default;
        }
        tbody tr:hover{
            background: #33373a;
        }
    </style>
</head>
<body>

    <?php $activ = 0; require "inc/navbar.php" ?>
    <div class="container" id="form-box">
        
            <div class="row">
                <div class="col-6">
                    <h3>Ajouter ici les test</h3>
                    <div class="form-group">
                        <label for="test" class="lbl">Ajouter un Test</label>
                        <input type="text" id="test" class="form-control" placeholder="Enter les nom du test">
                    </div>
                    <div class="form-group">
                        <label for="description" class="lbl">Description</label>
                        <textarea id="description" cols="15" class="form-control" rows="5"></textarea>
                    </div>
                    
                    
                    <button type="submit" id="testAdd" name="submit" class="btn btn-primary" style="margin-top: 20px;">Ajouter</button>
                </div>



                <div class="col-6">
                    <h3>Ajouter ici les paires question/reponses</h3>
                    <div class="form-group">
                        <label for="testname">Choisir le test</label>
                        <select name="" class="form-control" id="testname">
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question" >Question</label>
                        <textarea name="" class="form-control" id="question" cols="15" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer" >Reponse</label>
                        <input type="text" name="" class="form-control" placeholder="Enter la reponse" id="answer"></input>
                    </div>  
                    <div class="form-group">
                        <label for="note" >Note</label>
                        <input type="number" name="" class="form-control" placeholder="Enter la reponse" id="note"></input>
                    </div>

                    <button type="submit" id="addQa" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
            <div class="row mt-5">
                
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Test</th>
                                <th scope="col">Nomber de question</th>
                                <th scope="col">Nomber de participants</th>
                            </tr>
                        </thead>
                        <tbody id="fetchTable">

                        </tbody>
                    </table>
                
            </div>
        
    </div>
    <div id="dev">

    </div>
    <script src="js/JQ.js"></script>
    <script src="js/notify.js"></script>
    <script>

        $(document).ready(function(){

            // Add Test

            FetchTable();
            
            FetchTest();

            $('#testAdd').on( 'click', function() {
                
                var testName      = $('#test').val(),
                    description   = $('#description').val(),
                    typeAction = "test";

                if( testName == '' ){
                    //alert("il y'a des champs vides");  
                    $.notify("le champ test name est vide","warn");
                }
                else{
                    $.ajax({
                        url: 'inc/new.php',
                        method: 'post',
                        data:{testName:testName,description:description,typeAction:typeAction},
                        success:function(data){
                            
                            FetchTest();
                            FetchTable();
                            var d = data;
                            if( data == "Test Ajoute..." ){
                                //$.notify(";kjhgnfgbf","success");
                                
                                $.notify(data,"success");
                                
                                //document.write(data);
                                //$('.info').html("<b style='color:green'>" + data + "<b>");
                            }
                            else{
                                //$('.info').html("<b style='color:red'>" + data + "<b>");
                                
                                $.notify(data,"info");
                                //$.notify("data","info");
                            }
                        }
                    });
                }

            } );

        });

        //Add question/Answr الأسئلة/الأجوبة
        $('#addQa').on( 'click' , function(){
            
            var testname = $('#testname').val(),
                question = $('#question').val(),
                answer   = $('#answer').val(),
                point     = $('#note').val();

            if( question == '' || answer == ''){
                $.notify("il y'a des champ vide","warn");
            }
            else{
                $.ajax({
                        url: 'inc/new.php',
                        method: 'post',
                        beforeSend:function(){
                            $('#addQa').text('on cours ...');
                        },
                        data:{testname:testname,question:question,answer:answer,point:point,typeAction:'qa'},
                        success:function(data){
                            FetchTable();
                            var d = data;
                            $.notify(data,"info");
                            $('#addQa').text('Ajoute');
                            $('#dev').text(data);
                            set('input');
                            set('textarea');
                            //var i = inp.value;
                            /*inp.forEach( input => {
                                this.value = "";
                            } )*/

                        }
                    })
            }

        } )

        // Fetch Test    عرض الإمتحانات

        function FetchTest(){
            var fetch = "fetch";
            $.ajax({
                url: 'inc/getTest.php',
                method: 'post',
                data:{fetch:fetch},
                success:function(data){

                    $('#testname').html( data );
                    //$.notify(data,"info");

                }
            });
        }
        let char;
        function set(char){
            var inp = document.querySelectorAll(char);
            for (let char = 0; char < inp.length; char++) {
                inp[char].value = "";
            }
        }

        // Fetch data in the Table    عرض الإمتحانات

        function FetchTable(){
            var fetch = "fetch";
            $.ajax({
                url: 'inc/getTable.php',
                method: 'post',
                data:{fetch:fetch},
                success:function(data){

                    $('#fetchTable').html( data );
                    //$.notify(data,"info");

                }
            });
        }

        /*grecaptcha.ready(function() {
        grecaptcha.execute('6LfP2PgUAAAAADQpZluDrw78Hc4j3qxj58WxHIiL', {action: 'homepage'}).then(function(token) {
         // console.log(token);
         document.getElementById("token").value = token;
      });
  });*/

    </script>
</body>
</html>