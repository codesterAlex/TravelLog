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

 $currentDia = $_GET['id'];


  mysqli_select_db($connection,'travellog') or die(mysql_error);
  $plaQuery = "SELECT * FROM places WHERE id_diary = '$currentDia'";
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
        background-color:#010080;
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
	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="engine0/style.css" />
	<script type="text/javascript" src="engine0/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section --></head>
  <body bgcolor="#2e0049">
    <?php if(mysqli_num_rows($places)>0):?>
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container0">
	<div class="ws_images"><ul>
    <?php while($place = mysqli_fetch_assoc($places)):?>

    <li><img src="<?php echo $place['location'];?>" alt="<?php echo $place['place'];?>" title="<?php echo $place['place'];?>" class="nextLink" height="500px"/></li>
    <?php endwhile;?>
			</ul></div>
	<div class="ws_bullets"><div>
    <?php while($place = mysqli_fetch_assoc($places3)):?>
    <a href="#" title="<?php echo $place['place'];?>"><span>1</span></a>
    <?php endwhile;?>

			</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">wow slider</a> by WOWSlider.com v8.8</div>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="engine0/wowslider.js"></script>
	<script type="text/javascript" src="engine0/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
  <div id="diaries-h1" align="center">
  <h1 style="color:white;background-color:rgba(255,255,255,0.3);width:500px;border-radius:50px;text-shadow: 2px 2px 4px #000000;">Place-Space for Self Discovery</h1>
</div>
<div id="diary-list">
  <h1>Chapters of your Journey</h1>
  <ol>
    <?php while($newPla = mysqli_fetch_assoc($places2)):?>
    <li><a href="<?php echo "pages.php?id=".$newPla['id_place'];?>"><?php echo $newPla["place"]?></a></li>
    <?php endwhile;?>
  <ol>
  <?php else: ?>
  <h1 align="center" style="color:white;background-color:rgba(255,255,255,0.3);width:600px;border-radius:50px;text-shadow: 2px 2px 4px #000000;margin-left:350px">Sorry place Not added</h1>
<?php endif;?>
</div>
  </body>
</html>
