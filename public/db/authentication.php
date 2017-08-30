<?PHP

include('db_config.php');

function authenticate(){
    
    if(!isset($_SESSION['customer_identity']) && !isset($_SESSION['acc_number'])){
        header("Location:customer_login.php");
    }
}

?>

