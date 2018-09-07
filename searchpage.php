<?php
  session_start();
  if(!isset($_SESSION["userName"]))
  {
    header("location:index.php");
  };
  $userName = $_SESSION['userName'];

  $connection = mysqli_connect("localhost","root","") or die("Not connected to server");
  define("author","");
  define("user","");

  mysqli_select_db($connection,'travellog') or die(mysql_error);
  $currentPlace = $_GET['id'];
  $plaQuery = "SELECT * FROM places WHERE id_place = '$currentPlace' LIMIT 1";
  $places1 = mysqli_query($connection, $plaQuery);
  $places = mysqli_query($connection, $plaQuery);
        if(mysqli_num_rows($places1) >0)
        {
          while($rows = mysqli_fetch_assoc($places1))
          {
            $user = $rows['id_user'];
          }
        }

  $userNameSql = "SELECT * FROM user WHERE id = '$user'";
  $userResult = mysqli_query($connection,$userNameSql);

  if(mysqli_num_rows($userResult) >0)
  {
    while($rowss = mysqli_fetch_assoc($userResult))
    {
      $author = $rowss['userName'];
    }
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
      <link href="css/home-style.css" rel="stylesheet" type="text/css">
  </head>
  <body bgcolor="#2e0049">
    <?php while($place = mysqli_fetch_assoc($places)):?>
    <div id="container-page" class="paper-page">
          <div id="header-page">
              <h1>#<?php echo $place['place'];?></h1>
              <img src="<?php echo $place['location'];?>" width="600px" height="200px" align="center">
            </div>
            <div id="para-page">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $place['placeInfo'];?></p>
            </div>
          <div id="end-page">
            <table align="center">
              <td><img src="images/loveus.png" width="50px" height="50px"></td>
              <td>***By- <?php echo $author;?>***</td>
            </table>
          </div>
    </div>
    <?php endwhile;?>
  </body>
</html>
