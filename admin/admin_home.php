<?php
session_start();
	include('db/authentication.php');

	authenticate();


	$admin_id = $_SESSION['admin_identity'];
    $admin_name = $_SESSION['admin_name'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Swap Space Bank | Home</title>
</head>

<body>
    <h1>Swap Space Bank</h1>
    <h3>...since 2020</h3>
    <?php

    echo "<p>Admin ID:<strong>".$admin_id."</strong></p>";

    echo "<p>Admin Name:<strong>".$admin_name."</stong></p>";


    ?>

    <a href="admin_home.php">Home</a>
    <a href="add_customers.php">Add Customer</a>
    <a href="view_customers2.php">View Customers2</a>
    <a href="logout.php">Logout</a>

</body>
</html>
