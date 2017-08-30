<?php

function viewStatement($query){



  $trans = "";


  while($row = mysqli_fetch_array($query)){

    $trans .="<tr>";

    $trans .= "<td>".$row['transaction_date']."</td>";
    $trans .= "<td>".$row['transaction_type']."</td>";
    $trans .= "<td>".$row['sender']."</td>";
    $trans .= "<td>".$row['receiver']."</td>";
    $trans .= "<td>".$row['transfer_amount']."</td>";
    $trans .= "<td>".$row['initial_balance']."</td>";
    $trans .= "<td>".$row['final_balance']."</td>";


    $trans .="</tr>";


  }


  return $trans;

}

?>
