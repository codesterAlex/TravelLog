<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home-Travel Log</title>
    <link rel="stylesheet" type="text/css" href="css/home-style.css">
    <link href="images/logo.png" rel="shortcut icon">
  </head>
  <body>
    <header>
        <a href="travellog.php"><img src="images/logo.jpg" width="70px" height="70px" style="border-radius:100px;border: 2px dashed brown" id="logo" padding="5px"></a>
        <?php echo "<h5 style='float:left;padding:10px;'>&nbsp;&nbsp;&nbsp;<span style='color:dargreen'>user</spam><br/><span style='color:white'>$userName</span></h5>"?>
        <form method="GET" action="results.php">
          <input type="text" placeholder="Search places" size="50" name="searchedPlace">
          <input type="submit" value="Search">
        </form>
        <ul>
          <li><a href="profile.php">My Profile |</a></li>
          <li><a href="diaries.php">My Diaries |</a></li>
          <li><a href="myplaces.php">places |</a></li>
          <li><a href="logout.php">Log out</a></li>
        </ul>
    </header>
  </body>
</html>
