<?php

session_start();

include('db/db_config.php');

include('function.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>
</head>

<body>

    <h1>Swap Space Bank</h1>
    <h3>...since 2020</h3>

    <?php

    if(array_key_exists('login', $_POST)){
        $error = array();
        if(empty($_POST['uname'])){
            $error[] = "You have not entered your username";
        }else{
            $username = mysqli_real_escape_string($db, $_POST['uname']);
        }

        if(empty($_POST['pword'])){
            $error[] = "You have not entered password";

        }else{
            $pword = md5(mysqli_real_escape_string($db, $_POST['pword']));
        }

        if(empty($error)){

            $query= mysqli_query($db, "SELECT * FROM admin WHERE username = '".$username."' AND secured_password = '".$pword."' ") or die(mysqli_error($db));

			if(mysqli_num_rows($query)==1){
				$row = mysqli_fetch_array($query);

				$_SESSION['admin_identity'] = $row['admin_id'];
				$_SESSION['admin_name'] = $row['username'];



				header("Location:admin_home.php");//we now log the admin in
				}else{//number of row is not = 1...untrue

				$error_message = "Invalid username and password";
				header("Location:admin_login.php?err=$error_message");
					}
        }else{
			foreach ($error as $error){
			echo "<p>".$error."</p>";
			}//end of foreach loop

    }//end of error array is empty

	}


	if (isset($_GET['err'])){
	echo "<p><strong>".$_GET['err']. '<strong></p>';
	}
    ?>

    <h3>Please enter your Username and Password</h3>

    <form action="" method="post">
        <p>Username: <input type="text" name="uname"> </p>
         <p>Password: <input type="password" name="pword"> </p>

         <input type="submit" name="login" value="click to submit">







    </form>
</body>
</html>
