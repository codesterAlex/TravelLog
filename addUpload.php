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

    <header style="position:relative">
      <?php include "header.php"?>
    </header>
    <div id="new-upload">
      <div id="dia-form">
        <?php if(mysqli_num_rows($diaries)>0):?>
            <form action="placeUpload.php" method="POST" enctype="multipart/form-data">
              <h1 align="center">Add place</h1>
              <lable style="
                color:white;
                font-size:20px;
                font-weight:bold;
                padding-right: 20px;">Select Diaries </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select style="width:185px;height:30px;" name="diary" required>
              <?php while($diary = mysqli_fetch_assoc($diaries)):?>
                <option value="<?php echo $diary['id_diary'];?>"><?php echo $diary['title'];?></option>
              <?php endwhile;?>
          </select>
          <br>
          <br>
            <label>Place You want to add</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="place" placeholder="Enter place" class="inputField" size="20" required><br><br>
            <label>Upload picture of place</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="file" name="file"  value="upload photo of place " required><br>
            <br>
            <textarea rows="10" cols="70" name="placeInfo" placeholder="Describe your experience..."></textarea>
            <input align="center" type="submit" name="submit" value="Upload" id="dia-submit">
        </form>

        <?php else: ?>
          <h1>Sorry!!! You have no diaries.</h1>
        <?php endif;?>
      </div>
    </div>
  </body>
</html>
