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
  $diaries2 = mysqli_query($connection,$diaQuery);
  $diaries3 = mysqli_query($connection,$diaQuery);

 ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
      <link rel="stylesheet" type="text/css" href="css/home-style.css"  >

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
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
  <?php if(mysqli_num_rows($diaries)>0):?>
  <div id="wowslider-container0">
	<div class="ws_images"><ul>
		<!-- <li><img src="data0/images/5b8d7e0f37aa33.52111559.jpg" alt="My Memories" title="My Memories" id="wows0_0"/></li> -->
		<!-- <li><img src="data0/images/5b8d81306e5834.88463116.jpg" alt="5b8d81306e5834.88463116" title="Place Name" class="nextLink"/></li> -->
    <?php while($diary = mysqli_fetch_assoc($diaries)):?>

    <li><img src="<?php echo $diary['location'];?>" alt="<?php echo $diary['title'];?>" title="<?php echo $diary['title'];?>" class="nextLink" height="500px"/></li>
    <?php endwhile;?>
  </ul></div>
	<div class="ws_bullets"><div>
    <?php while($diary = mysqli_fetch_assoc($diaries3)):?>
    <a href="#" title="<?php echo $diary['title'];?>"><span>1</span></a>
    <?php endwhile;?>
			</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="place.php">wow slider</a> by WOWSlider.com v8.8</div>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="engine0/wowslider.js"></script>
	<script type="text/javascript" src="engine0/script.js"></script>
  <script>
  //alert("hello world");
//$('.nextLink').attr('href','http://www.google.com');
});
  </script>
	<!-- End WOWSlider.com BODY section -->
  <div id="diaries-h1" align="center">
  <h1 style="color:white;background-color:rgba(255,255,255,0.3);width:500px;border-radius:50px;text-shadow: 2px 2px 4px #000000;">Diaries-Books of your Journey</h1>
</div>
<div id="diary-list">
  <h1>Your Diaries</h1>
  <ol>
    <?php while($newDia = mysqli_fetch_assoc($diaries2)):?>
    <li><a href="<?php echo "places.php?id=".$newDia['id_diary'];?>"><?php echo $newDia["title"]?></a></li>
    <?php endwhile;?>
  <ol>
<?php else: ?>
  <h1 align="center" style="color:white;background-color:rgba(255,255,255,0.3);width:600px;border-radius:50px;text-shadow: 2px 2px 4px #000000;margin-left:350px">Sorry place Not added</h1>
<?php endif;?>
</div>

  </body>
</html>
