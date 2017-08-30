<?PHP

unset ($_SESSION['customer_identity']);
unset ($_SESSION['acc_number']);

header("Location:customer_login.php");


?>
