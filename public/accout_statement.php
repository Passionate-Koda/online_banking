<?php
session_start();

include ('db/authentication.php');

include('function.php');

authenticate();

$customer_id = $_SESSION['customer_identity'];
$account_number = $_SESSION['acc_number'];
$customer_name = $_SESSION['customer'];





?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
</head>

<body>
  <h1>Swap Space Bank</h1>
  <h3>...since 2020</h3>





  <?PHP
  echo "<p>Customer ID:<strong>".$customer_id."</strong></p>";
  echo "<p>Account Name:<strong>".$customer_name."</strong</p>";

  echo "<p>Account Number:<strong>".$account_number."</strong</p>";
  ?>

  <hr>
  <a href="customer_home.php">Customers Home</a>
  <a href="change_password.php">Change password</a>
  <a href="transfer_funds.php"> Transfer Funds</a>
  <a href="accout_statement.php">Account Statement</a>
  <a href="logout.php">Logout</a>


  <h2>Account Statement</h2>



  <table border="1"  >
    <?PHP

    $query = mysqli_query($db, "SELECT * FROM transaction WHERE customer_id=  '".$customer_id."'") or die(mysqli_error());

    ?>
    <tr>

      <th>Transaction Date</th><th>Type</th><th>Sender</th><th>Receiver</th><th>Transaction Amount</th><th>Previous Balance</th><th>Final Balance</th>



    </tr>

    <?php

    $bk = viewStatement($query);

    echo $bk;
    ?>


  </table>

</body>
</html>
