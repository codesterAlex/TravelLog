<?php
  session_start();
  if(!isset($_SESSION["userName"]))
  {
    header("location:index.php");
  };
  $userName = $_SESSION['userName'];

  $connection = mysqli_connect("localhost","root","") or die("Not connected to server");
  mysqli_select_db($connection,'travellog') or die(mysql_error);

 $SearchPlace = htmlentities($_GET['searchedPlace']);

  mysqli_select_db($connection,'travellog') or die(mysql_error);
  $plaQuery = "SELECT * FROM places WHERE place = '$SearchPlace'";
  $places = mysqli_query($connection,$plaQuery);
  $places2 = mysqli_query($connection,$plaQuery);
  $places3 = mysqli_query($connection,$plaQuery);

 ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
      <link href="css/home-style.css" rel="stylesheet" type="text/css">


      <style>
      #diary-list
      {
        border:2px solid #010080;
        background-color: rgba(255,255,255,0.8);
        margin:auto;
        height:auto;
        width:800px;
        padding-bottom:10px;
      }
      #diary-list h1
      {
        font-size: 45px;
        background-color:white;
        margin-top:0px;
        color:white;
        text-align: center;
        font-family: Freestyle Script;
        opacity: 0.8;
      }
      #diary-list li
      {

        background-color:white;
        margin-bottom: 10px;
        padding-left: 200px;
        width:270px;
        margin-left: 100px;
        border-left: 10px solid brown;
        color:black;
        font-size: 25px;

      }
      #diary-list li:hover
      {
        background-color: rgba(46,0,73,0.5);
        color : rgba(46,0,73,0.8);
      }
      #diary-list ol li a{
        text-decoration: none;
        color:black;
        font-size: 30px;
        font-family: Freestyle Script;
      }
      </style>
  <body bgcolor="#2e0049">
<div id="diary-list">
  <h1>Research Results:</h1>
  <ol>
    <?php if(mysqli_num_rows($places2)>0):?>
    <?php while($newPla = mysqli_fetch_assoc($places2)):?>
    <li><a href="<?php echo "searchpage.php?id=".$newPla['id_place'];?>"><?php echo $newPla["place"]?></a></li>
    <?php endwhile;?>
  <?php else: ?>
    <h1 style="color:black">Sorry Result Not found for: <?php echo $SearchPlace ?></h1>
  <?php endif;?>
  <ol>
</div>
  </body>
</html>
