<?php

require_once "coon.php";
$fatch = $_POST['fetch'];
$data  = '';

if( isset( $fatch ) && $fatch == "fetch" ){
    $selectTable = mysqli_query($coon, "SELECT * FROM test") 
        or die( mysqli_error($coon) );
    
    $num = mysqli_num_rows($selectTable);
    if( $num > 0 ){
        while( $row = mysqli_fetch_assoc($selectTable) ){
            $data .= "<tr>
            
                        <td>" . $row["tid"] . "</td>
                        <td>" . $row["testName"] . "</td>
                        <td>" . $row["numqa"] . "</td>
                        <td>" . $row["par"] . "</td>
            
                      </tr>\n";
        }
        echo $data;
    }
    else{
        echo "<td colspan='4' style='text-align: center;'>pas de test pour le moment</td>";
    }
    
}

?>