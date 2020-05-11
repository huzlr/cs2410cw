<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/css/styles.css">
  <meta charset="utf-8"/>
  <title>Find the Lost - Register</title>
</head>
<body>
  <div class="nav">
    <a href="/index.html">Home</a>
    <a href="/public/itemdb.php">Lost Item Database</a>
    <a href="/about.html">About Us</a>
    <a class="active" href="/register.php">Register</a>
    <a href="/login.php">Login</a>
    
  </div>

  <div style="padding-left:16px">
    <h2><center>Find the Lost</center></h2>
    <p><center> Fill in the form below to register.</center</p>
  </div>
  <p><center><z>Register</z></center>
    <br>
    <form action="register.php" method="POST">
      <Center><b>
      <br>
     First Name:<br>
     <input type="text" name="firstName" placeholder="First Name" required><br>
     Last Name:<br>
     <input type="text" name="lastName" placeholder="Last Name" required>
     <br>UserName:<br>
     <input type="text" name="userName" placeholder="Username" required>
     <br>Password:<br>
     <input type="password" name="password" placeholder="password" required>
	 <br>Repeat Password:<br>
     <input type="password" name="repeatPassword" placeholder="Repeat Password" required>
    </center></b>
    <br>
    <center><input type="submit" name="submit" value="submit" /></center>
    </form>
<?php 
	if(isset($_POST['submit'])){
	
	//start db connection and session to store user variables
	require_once("connection.php");
	session_start();
	
	//sanitise input
	$sanitizedFirstName = filter_var($_POST[firstName], FILTER_SANITIZE_STRING);
	$sanitizedLastName = filter_var($_POST[lastName], FILTER_SANITIZE_STRING);
	$sanitizedUserName = filter_var($_POST[userName], FILTER_SANITIZE_STRING);
	$sanitizedPW = filter_var($_POST[password], FILTER_SANITIZE_STRING);
	$sanitizedRepeatPW = filter_var($_POST[password], FILTER_SANITIZE_STRING);
	$EncryptedPassword = md5($sanitizedPW);
	
	if ($sanitizedPW != $sanitizedRepeatPW) {
	echo "Your passwords must match"; 

	}
	else{

    $sql = "INSERT INTO users (firstName, lastName, userName, password, userType)
    VALUES('$sanitizedFirstName','$sanitizedLastName','$sanitizedUserName','$EncryptedPassword', 'U')";
	
	if ($conn->query($sql) === TRUE) {
    $_SESSION['userName'] = $sanitizedUserName;
    $_SESSION['userType'] = 'U';
	header("location: user/userHome.php");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	}
	}
    ?>
    	
</body>
</html>


