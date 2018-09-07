<?php
  //error_reporting(0);
  session_start();
  if(!isset($_SESSION["userName"]))
  {
    header("location:index.php");
  };
  $userName = $_SESSION['userName'];

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

    <header>
      <?php include "header.php"?>
    </header>
    <br>
    <br>
    <br>
    <br>
    <div id="conatiner">
        <div id="new-diary" class="create-box">
          <a href="newUpload.php"><img class="new-dia-img"src="images/create.svg" width="200px" height="200px"></a>
          <a href="newUpload.php"><h1 class="new-dia-h1">Create New Diaries.</h1></a>
        </div>
        <div id="add-place" class="create-box">
          <a href="addUpload.php"><img class="add-pla-img"src="images/place.png" width="170px" height="170px"></a>
          <a href="addUpload.php"><h1 class="add-pla-h1">Add New Places to Diary.</h1></a>
        </div>
      </div>
    <footer>
    </footer>
  </body>
</html>
