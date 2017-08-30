<?php
 //$db = mysqli_connect("localhost", "root", "", "online_banking") or die (mysqli_error($db));
 
include('db_config.php');
 
 function authenticate(){
	 
	 if(!isset($_SESSION['admin_identity']) && !isset($_SESSION['admin_name'])){
         
         
             header("Location:admin_login.php");
     }
	 
	 
	 }
 
 ?>