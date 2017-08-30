<?PHP 


//we unset our session variables
unset($_SESSION['admin_identity']);

unset ($_SESSION['admin_name']);



//we redirect to admin login page
header("Location:admin_login.php")


?>