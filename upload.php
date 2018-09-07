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

//echo "$userId";
if(isset($_POST['submit']))
{

  $title = htmlentities($_POST['diaryTitle']);
  $title = ucwords($title);
  $file = $_FILES['file'];
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];

  $fileExt  = explode('.',$fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg','jpeg','png');

  if(in_array($fileActualExt, $allowed))
  {
    if($fileError === 0)
    {
      if($fileSize < 5120000)
      {
          $fileNameNew = uniqid('',true).".".$fileActualExt;
          $fileDestination = 'images/uploadedCover/'.$fileNameNew;

          $sql = "insert into diaries(id_diary,title,location,id_user)values('','$title','$fileDestination','$userId')";
          mysqli_query($connection,$sql);
          move_uploaded_file($fileTmpName, $fileDestination);
          header("location: travellog.php?uploadsuccess");
      }
      else {
        echo "Size exceeded";
      }
    }
    else{
      echo "Error";
    }
  }
  else{
    echo "Invalid Format";
  }
}
?>
