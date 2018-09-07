<?php
  session_start();
  if(!isset($_SESSION["userName"]))
  {
    header("location:index.php");
  };
  $userName = $_SESSION['userName'];
  $connection = mysqli_connect("localhost","root","") or die("Not connected to server");
  define("userId","");
  define("firstName","");
  define("lastName","");
  define("email","");
  define("location","");
  mysqli_select_db($connection,'travellog') or die(mysql_error);


  $sqlUser = "SELECT id FROM user WHERE userName = '$userName'";
  $resultId = mysqli_query($connection, $sqlUser);
  if(mysqli_num_rows($resultId)>0)
  {
    while($rows = mysqli_fetch_assoc($resultId))
    {
      $userId = $rows['id'];
    }
  }
  $picsql = "SELECT * FROM profilepic WHERE id_user ='$userId' ORDER BY id_user DESC LIMIT 1";
  $picResult = mysqli_query($connection,$picsql);

  if(mysqli_num_rows($picResult)>0)
  {
    while($pic = mysqli_fetch_assoc($picResult))
    {
      $location = $pic['location'];
    }
  }
  else {
    $location = "images/profile/defaultuser.png";
  }


  $infoSql = "SELECT * FROM user WHERE userName = '$userName'";
  $infoResult = mysqli_query($connection,$infoSql);


  while($info = mysqli_fetch_assoc($infoResult))
  {
    $firstName =$info["firstName"];
    $lastName = $info["lastName"];
    $email = $info["userEmail"];
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
    <style>
    #userprofile
    {
      margin:auto;
      width:801px;
      height:auto;
      padding-bottom:50px;
      background-color:rgba(32,0,32,0.6);
    }
    #profile h1
    {
      font-family: Freestyle script;
    }
    #profile-info
    {
      background-color:rgba(255,255,255,0.9);
      padding:0px;
    }

    #profile-info h1
    {
      color:black;
    }
    #profile-info a{
      background-color:#00baf7; text-decoration: none; color:white; padding:5px;border-radius:20px;
    }
    #profile-info a:hover{
      background-color:blue;
    }
    </style>
    <header>
      <?php include "header.php"?>
    </header>
    <br>
    <br>
    <br>
    <br>
    <div id="conatiner">
      <div id="userprofile">
        <img src="<?php echo $location;?>" width="450px" height="450px" style="border-radius:250px;margin-left:200px;margin-top:30px;font-family: Freestyle script;">
        <h1 align="center" style="color:white; font-size:40px; margin-left:-50px;font-family: Freestyle script;">User Name: <?php echo $userName;?></h1>
        <div id="profile-info">
          <h1 align="center" style="color:white;background-color: #4c0807;font-size:25px; font-family:sans-seriffont-family: Freestyle script;">Profile Info</h1>
          <h1 style="color:rgb(32,0,32); font-size:35px;margin-left:150px;font-family: Freestyle script;">Full Name: <?php echo $firstName.' '.$lastName;?></h1>
          <h1 style="color:rgb(32,0,32); font-size:35px;margin-left:150px;font-family: Freestyle script;">Email&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $email;?></h1>
          <a href="newprofile.php">Change Profile Picture</a>
        </div>
      </div>
      </div>
    <footer>
    </footer>
  </body>
</html>
