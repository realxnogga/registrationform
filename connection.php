<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registrationform";

 $con = mysqli_connect($servername, $username, $password, $dbname);

 if(!$con){
   die("Error" . mysqli_connect_error());
 }
?>
