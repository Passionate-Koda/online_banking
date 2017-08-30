<?php


function viewCustomer($customer){

  $result = "";
  while ($row = mysqli_fetch_array($customer)){


$result .= "<tr> ";


  $result .= "<td>".$row['customer_id']."</td>";
  $result .= "<td>".$row['firstname']."</td>";
  $result .= "<td>".$row['lastname']."</td>";
  $result .= "<td>".$row['email']."</td>";
  $result .= "<td>".$row['phone_number']."</td>";
  $result .= "<td>".$row['account_type']."</td>";
  $result .= "<td>".$row['opening_balance']."</td>";
  $result .= "<td>".$row['account_balance']."</td>";
  $result .= "<td>".$row['account_number']."</td>";
  $result .= "<td>".$row['password']."</td>";
  $result .= "<td>".$row['admin_id']."</td>";

  $result .="</tr>";


}

return $result;

}










 ?>
