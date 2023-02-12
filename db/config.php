<?php
 $server = "localhost";
 $username = "root";
 $password = "";
 $dbname = "ecommerce";

 $conn = mysqli_connect($server, $username, $password, $dbname);
 if($conn){
   // Do nothing
 } else{
   echo ("<h2> Failed to connect to to database </h2> <br>");
 }
?>