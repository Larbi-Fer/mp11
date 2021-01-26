<?php

require_once "coon.php";
$fatch = $_POST['fetch'];
$data  = '';

if( isset( $fatch ) && $fatch == "fetch" ){
    $selectTest = mysqli_query($coon, "SELECT * FROM test") 
        or die( mysqli_error($coon) );
    
    $num = mysqli_num_rows($selectTest);
    if( $num > 0 ){
        while( $row = mysqli_fetch_assoc($selectTest) ){
            $data .= "<option value='".$row['tid']."'>". $row['testName'] ."</option>\n";
        }
        echo $data;
    }
    else{
        echo "pas de test pour le moment";
    }
    
}

?>