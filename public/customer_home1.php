<?php
session_start();
include('db/authentication.php');
authenticate();
//$db = mysqli_connect("localhost", "root", "","online_banking") or die(mysqli_error($db));






$user_id = $_SESSION['customer_identity'];
$accnumber = $_SESSION['acc_number'];
$c = $_SESSION['customer'];

$select = mysqli_query($db, "SELECT * FROM customer WHERE account_number = '".$accnumber."'") or die(mysqli_error($db))


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
</head>

<body>
	<?php
	echo "<p> USER ID:<strong>".$user_id."</strong></p>";
	echo "<p> ACCOUNT NUMBER: <strong>".$accnumber."</strong></p>";
	echo "<p> ACCOUNT HOLDER : <strong>".$c."</strong></p>";

	?>

	<a href="customer_home.php"> HOME</a>
	<a href="funds.php">FUNDS TRANSFER</a>
	<a href="change_password.php">CHANGE PASSWORD</a>
	<a href="logout.php">LOGOUT</a> <br />


	<?php while($result = mysqli_fetch_array($select))
	{
		?>
		<?php echo "ACCOUNT BALANCE:" .$result['account_balance'] ?>



	<?php } ?>




</body>
</html>
