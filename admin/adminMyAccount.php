<!DOCTYPE html>
<html lang="en">
<head>
  <?php session_start();
  //if user type is not admin, restrict access
  if(($_SESSION['userType'] != 'A')){
    header('Location:..//restricted.html');
    die();
  }
	else{
		$userName = $_SESSION['userName'];
	}
  ?>
  <link rel="stylesheet" href="../css/styles.css">
  <meta charset="utf-8"/>
  <title>Find-the-Lost Admin Page</title>
</head>
<body>
  <div class="nav">
    <a href="../admin/adminHome.php">Home</a>
    <a href="../admin/adminPendingRequests.php">Pending Requests</a>
	<a class="active" href="../myAccount.php">My Account</a>
    <a href="../logout.php">Logout</a>

  </div>

  <div style="padding-left:16px">
    <h2><center>My Account</center></h2>
  </div>
  <p><center><z>Welcome <?php echo $userName ?> </z></center>
    <br>

<center><table style="border-spacing:16px"></center>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Username</th>
<th></th>
</tr>


<?php
	require_once("..//connection.php");
	$sql = "SELECT * FROM users WHERE (userName = '$userName')";
	$result = mysqli_query($conn, $sql);


    // output data of each row


if ($result->num_rows > 0) {
// output data of each row
while($user = $result->fetch_assoc()) {
echo "<td>" .$user["firstName"];
echo "<td>" . $user['lastName'] . "&nbsp</td>";
echo "<td>" . $user['userName'] . "&nbsp</td>";
echo "</tr>";
}
}

?>
</table>
<br>

    <form action="adminMyAccount.php" method="POST">
      <Center><b>
     <br>New Password:<br>
     <input type="password" name="newPassword" placeholder="New Password" required>
     <br>Repeat Password:<br>
     <input type="password" name="repeatPassword" placeholder="Repeat Password" required>
    </center></b>
    <br>
    <center><input type="submit" name="submit" value="Change password" /></center>
    </form>

<?php

if (isset($_POST['submit'])) {
	
//sanitise inputs
$sanitizedPassword = filter_var($_POST[newPassword], FILTER_SANITIZE_STRING);
$sanitizedRepeatPassword = filter_var($_POST[repeatPassword], FILTER_SANITIZE_STRING);
		
	if ($sanitizedPassword != $sanitizedRepeatPassword) {
	echo "Your passwords must match"; 

	}
	else{
			$EncryptedPassword = md5($sanitizedPassword);
				
			$sql = "UPDATE users
			SET Password = '$EncryptedPassword'
			WHERE (userName = '$userName')";
		
			if ($conn->query($sql) === TRUE) {
			echo "Password changed successfully";

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
				   
	}
}

require_once("..//footer.html");

?>

</body>
</html>
