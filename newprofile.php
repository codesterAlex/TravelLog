<?php
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

    <header style="position:relative">
      <?php include "header.php"?>
    </header>
    <div id="new-upload">
      <div id="dia-form">
        <form action="uploadpic.php" method="POST" enctype="multipart/form-data">
          <h1 align="center">Upload Your Picture</h1>
            <input type="file" name="file"  value="upload Diary cover " required><br>
            <br>
            <input align="center" type="submit" name="submit" value="Upload" id="dia-submit">
        </form>
      </div>
    </div>
  </body>
</html>
