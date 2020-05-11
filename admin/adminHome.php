<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
  session_start();
  //if user type is not admin, restrict access
  if(($_SESSION['userType'] != 'A')){
    header('Location:..//restricted.html');
    die();
  } ?>
  <link rel="stylesheet" href="../css/styles.css">
  <meta charset="utf-8"/>
  <title>Find-the-Lost Admin Page</title>
</head>
<body>
  <div class="nav">
    <a class="active" href="../admin/adminHome.php">Home</a>
    <a href="../admin/adminPendingRequests.php">Pending Requests</a>
	<a href="../myAccount.php">My Account</a>
    <a href="logout.php">Logout</a>

  </div>

  <div style="padding-left:16px">
    <h2><center>Admin Home</center></h2>
  </div>
  <p><center><z>Welcome <?php echo $_SESSION['userName'] ?> </z></center>
    <br>
   <p>You can view requests by clicking this <a href="../admin/adminPendingRequests.php">link</a></p>

</body>
</html>
