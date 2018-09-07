<?php
//DB Conncetion here
$connection = mysqli_connect("localhost","root","") or die("Not connected to server");
mysqli_select_db($connection,'travellog') or die(mysql_error);
$attempt = false;
if(isset($_POST['submit']))
{
	$userName = htmlentities($_POST['userName']);
	$password = htmlentities($_POST['userPassword']);
	$password = md5($password);

	$sql_e = "SELECT userName, password FROM user WHERE userName='$userName' AND password='$password'";
	$res_e = mysqli_query($connection,$sql_e);
	$count = mysqli_num_rows($res_e);
	//echo $res_e;

	if (mysqli_num_rows($res_e) > 0) {
		//$name_error = "Sorry... username already taken";
		//echo "<script type='text/javascript'>alert('$name_error');</script>";
		session_start();
		$_SESSION['userName']=$userName;
		header("Location:travellog.php");
	}
	else{
		$attempt = true;
		//$name_error = "Sorry, invalid data";
		//echo "<script type='text/javascript'>alert('$name_error');</script>";

	}
}







	//include "cool.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign up</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body style="background-image: url('images/back.jpg');background-size:1400px 900px">
		<div id="container">
			<div id="sign-form">
				<img src="images/user.png"/>
				<h2>Login</h2>
				<form action="#" method="POST" name="frm">
					<input type="text" name="userName" placeholder="User Name" class="inputField" size="20" pattern="^[A-Za-z0-9_]{1,15}$" title="Please enter your valid username" required><br>
					<br>
						<input type="password" name="userPassword" placeholder="password" class="inputField" size="20"required>
						<br>
						<input type="submit" value="login" id="submitBtn" name="submit">
				</form>
				<p>Already Have account? <a href="signin.php" style="background-color:rgba(255,255,255,0.9);padding:5px;">Sign In</a></p>
				<?php if($attempt){ ?>
				<p Style="background-color:red;color:white;width:300px;margin:auto" align="center"> Invalid username/Password</p>
			<?php } ?>
			</div>
			<div id="AlreadError">
				<?php if (isset($email_error)): ?>
      	<span><?php echo $email_error; ?></span>
      <?php endif ?>
			</div>
		</div>
	</body>
</html>
