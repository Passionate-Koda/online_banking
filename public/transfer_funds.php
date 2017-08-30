<?PHP

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

  echo "<p>Account Number:<strong>".$account_number."</strong</p><br><hr>";

  ?>





  <a href="customer_home.php">Customers Home</a>
  <a href="change_password.php">Change password</a>
  <a href="transfer_funds.php"> Transfer Funds</a>
  <a href="accout_statement.php">Account Statement</a>
  <a href="logout.php">Logout</a>




  <?PHP
  $query = mysqli_query($db, "SELECT account_balance FROM customer WHERE account_number = '".$account_number."' ") or die(mysqli_error());

  $response = mysqli_fetch_array($query);

  $sender_acc_balance = $response['account_balance'];

  ?>






  <h3>Funds Transfer</h3>

  <?PHP
  echo "<h3>Account balance: ".$sender_acc_balance."</h3>"
  ?>

  <?PHP

  if (isset($_POST['transfer'])){
    if(empty($_POST['acc_number']) || empty($_POST['amount'])){

      $msg = "Some fields are missing";
      header("Location:transfer_funds.php?msg=$msg");
    }elseif(!is_numeric($_POST['amount'])){
      $msg= "Please enter numeric values";
      header("Location:transfer_funds.php?msg=$msg");
    }elseif($_POST['acc_number'] == $account_number){
      $msg = "You can't transfer to your same account ";
      header("Location:transfer_funds.php?msg=$msg");
    }else{

      $receiver= mysqli_real_escape_string($db, $_POST['acc_number']);

      $transfer_amount = mysqli_real_escape_string($db, $_POST['amount']);


      $query = mysqli_query($db, "SELECT customer_id, firstname, lastname, account_balance FROM customer WHERE account_number = '".$receiver."'") or die(mysqli_error());


      if(mysqli_num_rows($query) ==1){
        $recipient = mysqli_fetch_array($query);
        $recipient_id = $recipient['customer_id'];
        $recipient_name = $recipient['firstname'].' '.$recipient['lastname'];

        $recipient_current_balance = $recipient['account_balance'];

        //mathematical transaction

        if($sender_acc_balance < $transfer_amount){
          $msg = "Insufficient Funds. Operations Failed";
          header("Location:transfer_funds.php?msg=$msg");
        }else{
          $sender_new_balance = ($sender_acc_balance - $transfer_amount);
          $recipient_new_balance = ($transfer_amount + $recipient_current_balance);

          //senders account


          $sender_update = mysqli_query($db, "UPDATE customer SET account_balance = '".$sender_new_balance."' WHERE account_number = '".$acc_number."' ") or die(mysqli_error());

          //we update the reciever

          $recipient_update = mysqli_query($db, "UPDATE customer SET account_balance = '".$recipient_new_balance."'  WHERE account_number ='".$receiver."' ") or die(mysqli_error());


          //We insert for sender


          $sender_insert = mysqli_query($db, "INSERT INTO transaction VALUES (NULL, NOW(), 'debit', 'self',
          '".$recipient_name."',
          '".$transfer_amount."',
          '".$sender_acc_balance."',
          '".$sender_new_balance."',
          '".$customer_id."'    )") or die(mysqli_error());



          $recipient_insert = mysqli_query($db, "INSERT INTO transaction
            VALUES(NULL, NOW(),
            'credit',
            '".$customer_name."',
            '".$recipient_name."',
            '".$transfer_amount."',
            '".$recipient_current_balance."',
            '".$recipient_new_balance."',
            '".$recipient_id."'    )") or die(mysqli_error());

            $success = "Transaction Successful";
            header("Location:transfer_funds.php?success=$success");
          }
        }else{//if not equal to one


          $msg = "Operation Failed. Please Try again";
          header("Location:transfer_funds.php?msg=$msg");


        }


      }


    }//End

    if(isset($_GET['msg'])){
      echo '<p>'.$_GET['msg'].'</p>';
    }

    if(isset($GET['success'])){
      echo '<h3><em>'.$_GET['success'].'</em></h3>';
    }


    ?>



    <form action="" method="post">

      <p>Enter Account Number: <input type="text" name="acc_number"> </p>
      <p>Enter Amount to transfer: <input type="text" name="amount"> </p>

      <input type="submit" name="transfer" value="transfer">

    </form>






















































  </body>
  </html>
