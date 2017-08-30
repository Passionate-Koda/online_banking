<?php

	session_start();
	include('db/authentication.php');

	authenticate();


	$admin_id = $_SESSION['admin_identity'];
    $admin_name = $_SESSION['admin_name'];


    $account = array("Fixed", "Current", "Domicilary");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Swap Space Bank | Add Customers</title>
</head>

<body>
    <h1>Swap Space Bank</h1>
    <h3>...since 2020</h3>
    <?php

    echo "<p>Admin ID:<strong>".$admin_id."</strong></p>";

    echo "<p>Admin Name:<strong>".$admin_name."</strong></p>";


    ?>

    <a href="admin_home.php">Home</a>
    <a href="add_customers.php">Add Customer</a>
    <a href="view_customers2.php">View Customers2</a>
    <a href="logout.php">Logout</a>

    <hr/>


    <h3>Customers Registration</h3>
    <p>Please fill in the details</p>

        <?php
         if (array_key_exists('register', $_POST)){
             $error = array();

             if(empty ($_POST['fname'])){
                 $error[] = "Please enter Customers Firstname";

             }else{
                 $fname= mysqli_real_escape_string($db, $_POST['fname']);
             }

              if(empty ($_POST['lname'])){
                 $error[] = "Please enter Customers lastname";

             }else{
                 $lname= mysqli_real_escape_string($db, $_POST['lname']);
              }

              if(empty ($_POST['email'])){
                 $error[] = "Please enter Customers email";

             }else{
                 $email= mysqli_real_escape_string($db, $_POST['email']);
              }


              if(empty ($_POST['phone'])){
                 $error[] = "Please enter Customers phonenumber";

             }else{
                 $phone= mysqli_real_escape_string($db, $_POST['phone']);
              }


             if(empty ($_POST['acc_type'])){
                 $error[] = "Please enter Customers Account Type";

             }else{
                 $acc_type= mysqli_real_escape_string($db, $_POST['acc_type']);
              }

              if(empty ($_POST['balance'])){
                 $error[] = "Please enter Customers balance";

             }elseif(!is_numeric($_POST['balance'])){
                  $error[]= "expecting a numeric value for opening balance";
              }else{
                  $balance= mysqli_real_escape_string($db, $_POST['balance']);
              }

              if(empty ($_POST['pword'])){
                 $error[] = "Please enter Customers Password";

             }else{
                 $password= md5(mysqli_real_escape_string($db, $_POST['pword']));
              }


             if(empty($error)){

                 $query = mysqli_query($db, "INSERT INTO customer
                                            VALUES(NULL,
                                                    '".$fname."',
                                                    '".$lname."',
                                                    '".$email."',
                                                    '".$phone."',
                                                    '".$acc_type."',
                                                    '".$balance."',
                                                    '".$balance."',
                                                    '".rand(1000000000,99999999999)."',
                                                    '".$password."',
                                                    '".$admin_id."')") or die(mysqli_error($db));


                 $success = "Customer Successfully Added";
                 header ("Location:add_customers.php?success=$success");

                 unset ($_POST['fname']);
                 unset ($_POST['lname']);
                 unset ($_POST['email']);
                 unset ($_POST['phone']);
                 unset ($_POST['acc_type']);
                 unset ($_POST['balance']);
                 unset ($_POST['pword']);


             }else{
                 foreach ($error as $error){
                     echo "<p>".$error."</p>";
                 }
             }


         }
		 if(isset($_GET['success'])){
			 echo "<p>".$_GET['success']."</p>";
			 }

        ?>


    <form action="" method="post">
    <p>Firstname: <input type="text" name="fname" value="<?PHP  if(isset ($_POST['fname'])){echo $_POST['fname'];}         ?>"> </p>
    <p>Lastname <input type="text" name="lname" value="<?PHP  if(isset ($_POST['lname'])){echo $_POST['lname'];}         ?>"> </p>
    <p>Email: <input type="email" name="email" value="<?PHP  if(isset ($_POST['email'])){echo $_POST['email'];}         ?>"> </p>
    <p>Phonenumber: <input type="text" name="phone" value="<?PHP  if(isset ($_POST['phone'])){echo $_POST['phone'];}         ?>"> </p>
    <p>Account Type: <select name="acc_type" value="<?PHP  if(isset ($_POST['acc_type'])){echo $_POST['acc_type'];}         ?>">
                            <option value="">Select Account Typ</option>
        <?php foreach($account as $account){              ?>
        <option value="<?php    echo $account        ?>" <?PHP if (isset($_POST['acc_type'])&& $_POST['acc_type']== $account ){echo 'selected="selected"';} ?>><?php echo $account   ?></option>

        <?php    } ?>





        </select></p>

        <p>Opening Balance <input type="text" name="balance" value="<?PHP  if(isset ($_POST['balance'])){echo $_POST['balance'];}         ?>">   </p>

        <p>Password <input type="password" name="pword">   </p>

        <input type="submit" name="register" value="Register">







        </form>


</body>
</html>
