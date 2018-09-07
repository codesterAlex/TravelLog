<?php
  session_start();
  if(!isset($_SESSION["userName"]))
  {
    header("location:index.php");
  };
  $userName = $_SESSION['userName'];

  $connection = mysqli_connect("localhost","root","") or die("Not connected to server");
  define("userId","");


  mysqli_select_db($connection,'travellog') or die(mysql_error);

  $sqlUser = "SELECT id FROM user WHERE userName = '$userName'";
  $resultId = mysqli_query($connection,$sqlUser);
  if(mysqli_num_rows($resultId)>0)
  {
    while($rows = mysqli_fetch_assoc($resultId))
    {
      $userId = $rows['id'];
    }
  }



  mysqli_select_db($connection,'travellog') or die(mysql_error);
  $diaQuery = "SELECT * FROM diaries WHERE id_user = '$userId'";
  $diaries = mysqli_query($connection,$diaQuery);

 ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
      <link href="css/home-style.css" rel="stylesheet" type="text/css">
  </head>
  <body>

  </body>
</html>
