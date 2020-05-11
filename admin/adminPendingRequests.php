<!DOCTYPE html>
<html lang="en">
<head>
  <?php session_start();
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
    <a href="../admin/adminHome.php">Home</a>
    <a class="active" href="../admin/pendingRequests.php">Pending Requests</a>
	<a href="../myAccount.php">My Account</a>
    <a href="../logout.php">Logout</a>

  </div>

  <div style="padding-left:16px">
    <h2><center>Admin Home</center></h2>
  </div>
  <p><center><z>Welcome <?php echo $_SESSION['userName'] ?> </z></center>
    <br>
    <h1>Pending Requests</h1>
    <?php
	//db conn
    require_once("..//connection.php");
	//picks out pending requests from database for review.
    $sql = "SELECT * FROM requests WHERE (status = 'Pending')";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
	// this while loop outputs the requests waiting for action for each row in db
    while($row = $result->fetch_assoc()) {
        for($i = 1; $i <= result +1; $i++){
        echo  nl2br
		(" \n Pending Request $i".
		" \n Requested by: " . $row["userName"].
		" \n Requested on: " . $row["dateRequested"].
		" \n Reason: " . $row["reason"]);
		
	$itemID = $row["itemID"];
	$sql2 = "SELECT * FROM items WHERE (itemID = '$itemID')";
	$result2 = mysqli_query($conn, $sql2);
	$row2 = $result2->fetch_assoc();
		
	?>
		<button type="button" class="collapsible">View Details</button>
<div class="content">
<table style="width:100%" border="1" class="center" id="cssTable">
  <tr>
	<th>Photo</th>
    <th>Category</th>
    <th>Colour</th> 
    <th>Time found</th>
    <th>Place found</th>
    <th>Description</th>
  </tr>
  <tr>
    <td><img src="<?php echo $row2['photo']; ?> "alt="Image" height="140" width="140"></td>
    <td><?php echo $row2['category']; ?></td> 
    <td><?php echo $row2['colour']; ?></td>
    <td><?php echo $row2['foundTime']; ?></td>
    <td><?php echo $row2['foundPlace']; ?></td>
    <td><?php echo $row2['description']; ?></td>
  </tr>
</table>

<div class="form">
  <form action="adminPendingRequests.php" method="POST">
  <input type="hidden" name="requestID" value="<?= $row["requestID"] ?>" >
  <input type="submit" name="Approve" value="Approve" />
  <input type="submit" name="Deny" value="Deny" />
  <br></br>
  </form>
</div>
</div>
  
</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("activeCollapsible");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
		

				<?php
		;
    }
	}
    
} else {
    echo "You have no requests pending approval";
}
	if(isset($_POST['Approve'])){
	$userName = $_SESSION['userName'];
	$sql2 = "UPDATE requests
        SET status = 'Approved'
        WHERE (userName = '$userName' AND requestID = '$_POST[requestID]' )";
		
		if ($conn->query($sql2) === TRUE) {
		echo "Request approved successfully";

	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	}
	elseif(isset($_POST['Deny'])){
	$userName = $_SESSION['userName'];
	$sql2 = "UPDATE requests
        SET status = 'Denied'
        WHERE (userName = '$userName' AND requestID = '$_POST[requestID]' )";
		
		if ($conn->query($sql2) === TRUE) {
		echo "Request denied successfully";

	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	}
	require_once("..//footer.html");
  ?>

</body>
</html>
