<?php
  require_once "db/config.php";
  session_start();

   if(!isset($_SESSION['loggedIn']) || isset($_SESSION['loggedIn']) !== true) {
          header("location: php/login.php");
      }else{
       echo("Welcome ".$_SESSION['userName']." you can now use this website <br>");
      }
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
 <nav>
   <ul>
     <li> <a href="php/logout.php">Logout</a> </li>
   </ul>
 </nav>
</body>
</html>


