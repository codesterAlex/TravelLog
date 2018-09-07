<?php
//DB Conncetion here
$connection = mysqli_connect("localhost","root","") or die("Not connected to server");
mysqli_select_db($connection,'travellog') or die(mysql_error);

if(isset($_POST['submit']))
{
	$email = htmlentities($_POST['userEmailAdd']);
  $userName = htmlentities($_POST['userName']);

	$sql_e = "SELECT userEmail, userName FROM user WHERE userEmail='$email' OR userName='$userName'";

  $res_e = mysqli_query($connection,$sql_e);
	$count = mysqli_num_rows($res_e);
	//echo $res_e;

	if (mysqli_num_rows($res_e) > 0) {
		$name_error = "Sorry... username already taken";
		echo "<script type='text/javascript'>alert('$name_error');</script>";
		//header("Location:index.php");
	}
	else{
			$FirstName = htmlentities($_POST['userFirstName']);
			$LastName = htmlentities($_POST['userLastName']);
			$email = htmlentities($_POST['userEmailAdd']);
			$password = htmlentities($_POST['userPassword']);
      $userName = htmlentities($_POST['userName']);
			$password = md5($password);

			$sql = "insert into user(id,firstName,lastName,userEmail,userName,password)values('','$FirstName','$LastName','$email','$userName','$password')";
			$result = mysqli_query($connection,$sql);
			echo "<script>alert('Account Created');</script>";
			header("Location:index.php");

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
				<h2>Sign Up</h2>
				<form form action="#" method="post" name="frm">
						<input type="text" name="userFirstName" placeholder="First Name" class="inputField" size="20" pattern="[A-Za-z]{1,32}" title="Please enter your valid first name" required><br>
						<br>
						<input type="text" name="userLastName" placeholder="Last Name" class="inputField" size="20" pattern="[A-Za-z]{1,32}" title="Please enter your valid last name" required><br>
						<br>
						<input type="email" name="userEmailAdd" placeholder="Email Address" class="inputField" size="20"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please enter your vali email address" required><br>
						<br>
            <input type="text" name="userName" placeholder="User Name" class="inputField" size="20" pattern="^[A-Za-z0-9_]{1,15}$" title="Please enter your valid username" required><br>
						<br>
						<input type="password" name="userPassword" placeholder="password" class="inputField" size="20"required>
						<br>
						<input type="submit" value="Sign Up" id="submitBtn" name="submit">
				</form>
				<p>Already Have account? <a href="signin.php">Sign In</a></p>
			</div>
			<div id="AlreadError">
				<?php if (isset($email_error)): ?>
      	<span><?php echo $email_error; ?></span>
      <?php endif ?>
			</div>
		</div>
	</body>
</html>
