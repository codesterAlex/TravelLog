<?php
session_start();
if(!isset($_SESSION["userName"]))
{
  header("location:index.php");
};
$userName = $_SESSION['userName'];

$connection = mysqli_connect("localhost","root","") or die("Not connected to server");
define("userId","");
define("id_diary","");


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
if(mysqli_num_rows($diaries)>0)
{
  while($diary = mysqli_fetch_assoc($resultId))
  {
    $id_diary = $diary['id_diary'];
  }
}



//echo "$userId";
if(isset($_POST['submit']))
{
  $diaryId = htmlentities($_POST['diary']);
  $place = htmlentities($_POST['place']);

  $placeInfo = addslashes($_POST['placeInfo']);
  $placeInfo = nl2br(str_replace(" ", " &nbsp;", $placeInfo));

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
          $fileDestination = 'images/uploaded/'.$fileNameNew;

          $sql = "insert into places(id_place,place,location,placeInfo,id_diary,id_user)values('','$place','$fileDestination','$placeInfo','$diaryId','$userId')";
          $backResult = mysqli_query($connection,$sql);
          move_uploaded_file($fileTmpName, $fileDestination);
          header("location: travellog.php?uploadsuccess");
          echo $backResult;
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
