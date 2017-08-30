<?php
session_start();

include('db/authentication.php');

authenticate();

$customer_id = $_SESSION['customer_identity'];
$account_number = $_SESSION['acc_number'];
$customer_name = $_SESSION['customer'];



$query = mysqli_query($db, "SELECT firstname, lastname, account_number, account_balance FROM customer WHERE customer_id = '".$customer_id."' AND account_number = '".$account_number."' ");

$info = mysqli_fetch_array($query);

$first_name = $info['firstname'];
$last_name = $info['lastname'];
$acc_number = $info['account_number'];
$account_balance = $info['account_balance'];





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

  echo "<p>Account Number:<strong>".$acc_number."</strong</p>";

  if(isset($_GET['success'])){

    echo"<p>".$_GET['success']."</p>";
  }
  ?>
  <hr>

  <a href="customer_home.php">Customers Home</a>
  <a href="change_password.php">Change password</a>
  <a href="transfer_funds.php"> Transfer Funds</a>
  <a href="accout_statement.php">Account Statement</a>
  <a href="logout.php">Logout</a>
  <?PHP
  echo "<p>ACCOUNT NAME:".$first_name.' '.$last_name."</p>";

  echo "<p>ACCOUNT NUMBER:".$account_number."</p>";

  echo "<p>ACCOUNT BALANCE:".$account_balance."</p>";




  ?>





</body>
</html>
