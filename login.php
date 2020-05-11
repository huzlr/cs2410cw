<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/css/styles.css">
  <meta charset="utf-8"/>
  <title>Find the Lost - Login</title>
</head>
<body>
  <div class="nav">
    <a href="/index.html">Home</a>
    <a href="/public/itemdb.php">Lost Item Database</a>
    <a href="/about.html">About Us</a>
    <a href="/register.php">Register</a>
    <a class="active" href="/login.php">Login</a>
  </div>

  <div style="padding-left:16px">
    <h2><center>Find the Lost</center></h2>
    <p><center>Enter your Account Details below to login!</center></p>
  </div>
  <p><center><z>Login</z></center>

    <form action="login.php" method="POST">
      <Center><b>
     <br>Username:<br>
     <input type="text" name="userName" placeholder="Username" required>
     <br>Password:<br>
     <input type="password" name="password" placeholder="Password" required>
    </center></b>
    <br>
    <center><input type="submit" name="submit" value="Login" /></center>
    </form>
</body>

<?php	
if(isset($_POST['submit'])){

//start db connection
require_once("connection.php");

//start session to store username and user type variables
session_start();

//sanitise inputs
$sanitizedUserName = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
$sanitizedPW = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

//hash password to match database record
$EncryptedPassword = md5($sanitizedPW);

$sql = "SELECT userName, userType FROM users WHERE (userName = '$sanitizedUserName' 
AND password = '$EncryptedPassword')";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) > 0) {
	$_SESSION['userName'] = $sanitizedUserName;
	
	if($user['userType'] == 'U'){
		$_SESSION['userType'] = 'U';
		header("location: user/userHome.php");
	}
	elseif($user['userType'] == 'A'){
		$_SESSION['userType'] = 'A';
		header("location: admin/adminHome.php");
		}
	}
	else
  { 
  
?>
<div class="error">
					<h5>Invalid username or password provided</h5>
				</div>	
</html>
<?php } }
?>