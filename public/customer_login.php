
<?PHP

session_start();

include('db/db_config.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>customer login</title>
</head>

<body>
  <h1>Swap Space BAnk</h1>
  <h3>...since 2020</h3>


  <?PHP
  if(isset($_POST['submit'])){

    $error = array();


    if(empty($_POST['acc_number'])){
      $error[] = "you have not entered Account number";
    }elseif(!is_numeric($_POST['acc_number'])){

      $error[]= "expecting a numeric value for Account Number";
    }else{
      $acc_number = mysqli_real_escape_string($db, $_POST['acc_number']);
    }




    if(empty($_POST['pword'])){
      $error[] = "Please enter password";
    }else{
      $password = md5(mysqli_real_escape_string($db, $_POST['pword']));
    }




    if(empty($error)){

      $query = mysqli_query($db, "SELECT * FROM customer WHERE account_number = '".$acc_number."' AND password = '".$password."' " ) or die (mysqli_error($db));

      if(mysqli_num_rows($query)==1){

        $row = mysqli_fetch_array($query);

        $_SESSION['customer_identity'] = $row['customer_id'];
        $_SESSION['acc_number'] = $row['account_number'];
        $_SESSION['customer'] = $row['firstname'].' '.$row['lastname'];




        header("Location:customer_home.php");
      }else{

        $error_message = "invalid account name and password";

        header("Location:customer_login.php?err=$error_message");}

      }else{
        foreach ($error as $error){
          echo "<P>".$error."</p>";
        }
      }






    }

    if(isset($_GET['err'])){
      echo "<p>".$_GET['err']."</p>";
    }




    ?>






    <h3>Please enter your Username and Password</h3>

    <form action="" method="post">
      <p>Account number: <input type="text" name="acc_number"> </p>

      <p>Password: <input type="password" name="pword">  </p>

      <input type="submit" name="submit" value="login">

    </form>




  </body>
  </html>
