<?php 

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "mp11";

    //$coon = mysqli_connect( $host, $user, $pass, $db ) ;
    

    /*if( $coon -> connect_error ){
        echo "no ok";
    }
    else{
        echo "ok";
    }*/
    try{
        $coon = new mysqli($host, $user, $pass, $db);
        //$coon->set_charset( charset: "utf8mb4" );
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
    
?>