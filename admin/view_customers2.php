<?PHP $db= mysqli_connect("localhost", "root", "", "online_banking") or die(mysqli_error($db));

session_start();
	include('db/authentication.php');

	include('function.php');

	authenticate();


	$admin_id = $_SESSION['admin_identity'];
    $admin_name = $_SESSION['admin_name'];
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Swap Space Bank | View Customer</title>
</head>

<body>

    <?php

     echo "<p>Admin ID:<strong>".$admin_id."</strong></p>";

    echo "<p>Admin Name:<strong>".$admin_name."</stong></p>";



    ?>

    <a href="admin_home.php">Home</a>
    <a href="add_customers.php">Add Customer</a>
    <a href="view_customers2.php">View Customers2</a>
    <a href="logout.php">Logout</a>

    <table border="1">
			<?php

			$select = mysqli_query($db, "SELECT * FROM customer") or die(mysqli_error($db));

			?>
        <tr>
            <th>Customers Id</th><th>Firstname</th><th>Lastname</th><th>eEmail</th><th>Phone Number</th><th>Account Type</th><th>Opening Balance</th><th>Account Balance</th><th>Account Number</th><th>Password</th><th>Admin Id</th>

        </tr>



			<?php

			$bank = viewCustomer($select);

			echo $bank;


			 ?>

    </table>


</body>
</html>
