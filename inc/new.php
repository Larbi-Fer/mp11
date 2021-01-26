<?php

use function PHPSTORM_META\type;

session_start();

require_once "coon.php";
$mid = $_SESSION["id"];
$typeAction = mysqli_real_escape_string($coon,$_POST["typeAction"]);
if( isset( $_POST['typeAction'] ) && $_POST['typeAction'] == 'test' ){
    
    $testName        = mysqli_real_escape_string($coon,$_POST["testName"]);
    $description = mysqli_real_escape_string($coon,$_POST["description"]);
    if( empty($typeAction) ){
        echo "le champ test name est vide";
    }
    else{
        $insertTest = mysqli_query($coon,"INSERT INTO 
            test(mid, testName, description, numqa, par)
            values($mid,'$testName','$description',0,0)")
            or die(mysqli_error($coon));
        if( $insertTest ){
            echo "Test Ajoute...";
        }
        else{
            echo "test Not Ajoute...";
        }
    }
}
if( isset( $_POST['typeAction'] ) && $_POST['typeAction'] == 'qa' ){


    $testname = $_POST['testname'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $point = $_POST['point'];

    if( empty($question) || empty($answer) || empty($point) ){
        echo "il y'a des champ vide";
    }
    else{
        $addQa = mysqli_query($coon,"INSERT INTO qa(mid,tid,qua,answer,point)
        VALUES( $mid ,  '$testname' , '$question' , '$answer' , $point )")
        or die( mysqli_error($coon) );

        $selectQa = $coon->prepare("SELECT * FROM qa WHERE tid=$testname");
        //$selectQa->bind_param(type("i"),$testname);
        $selectQa->execute();
        $reselt = $selectQa->get_result();
        $numQ = $reselt->num_rows;

        $updateQa = $coon->prepare("UPDATE Test SET numqa=$numQ WHERE tid=$testname");
        //$updateQa->bind_param(type("ii"),$numQ,$testname);
        $updateQa->execute();

        if( $addQa && $updateQa->execute() ){
            echo "paire question/reponse ajoute";
        }
        else{
            echo "error";
        }
    }


}


?>