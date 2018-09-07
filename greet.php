<?php
mysql_connect("localhost","root","") or die("Not connected to server");
mysql_select_db('travellog') or die(mysql_error);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body bgcolor="#2e0049">
    <br>
    <h1 style="color:white">Welcome to Travel Log</h1>
    <h4 style="color:white">Save memories to relive eveything moment</h4>
    <h1><a href="signin.php">Signin</a></h1>
  </body>
</html>
