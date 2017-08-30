<?php
session_start();

include("db/authentication.php");
authenticate();

$customer_id = $_SESSION['customer_identity'];
$account_number = $_SESSION['acc_number'];
$customer = $_SESSION['customer'];


$query= mysqli_query($db, "SELECT * FROM customer WHERE account_number = '".$account_number."' AND customer_id = '".$customer_id."' ") or die(mysqli_error($db));

$info = mysqli_fetch_array($query);

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Change Password</title>
</head>


<body>

  <h1>Swap Space Bank</h1>
  <h3>...since 2020</h3>



  <?php
  echo "<p>Customer ID:<strong>".$customer_id."</strong></p>";

  echo "<p>Customer's Name:<strong>".$customer."</strong></p>";
  echo "<p>Account Number:<strong>".$account_number."</strong</p>";



  ?>
  <hr>

  <a href="customer_home.php">Customers Home</a>
  <a href="change_password.php">Change password</a>
  <a href="transfer_funds.php"> Transfer Funds</a>
  <a href="accout_statement.php">Account Statement</a>
  <a href="logout.php">Logout</a>




  <?php

  if(isset ($_POST['submit'])){

    $error = array();

    $_POST['old_pword'] = md5($_POST['old_pword'])  ;


    If(empty($_POST['old_pword'])){
      $error[] = "Enter Old Password";



    }elseif ($_POST['old_pword'] != $info['password']){
      $error[] = "Wrong Old Password";
    } else{
      $old_pword= md5(mysqli_real_escape_string($db, $_POST['old_pword']));
    }


    if (empty($_POST['new_pword'])){
      $error[] = "Enter New Password";
    }else{
      $new_pword = md5(mysqli_real_escape_string($db, $_POST['new_pword']));
    }

    if(empty($_POST['cn'])){
      $error[] = "Please Confirm New Password";
    }elseif(isset($_POST['cn']) && $_POST['cn'] != $_POST['new_pword']){
      $error[] = "New Password not Match";
    }else{
      $cn = md5(mysqli_real_escape_string($db, $_POST['cn']));
    }


    if(empty($error)){
      $query = mysqli_query($db, "UPDATE customer
        SET password= '".$cn."'
        WHERE account_number ='".$account_number."'") or die (mysqli_error($db));

        $success = "Password successfully changed";
        header("Location:customer_home.php?success=$success");



      }else{
        foreach($error as $error){
          echo "<p>".$error."</p>";
        }
      }
    }

    if(isset($_GET['success'])){

      echo"<p>".$_GET['success']."</p>";
    }






    ?>

    <form action="" method="post">


      <p>Old Password: <input type="password" name="old_pword" > </p>
      <p>New Password: <input type="password" name="new_pword"> </p>
      <p>Confirm New Password: <input type="password" name="cn"  ></p>
      <input type="submit" name="submit" value="Change Password" >






    </form>




  </body>
  </html>
