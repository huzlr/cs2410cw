<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    session_start();
  if(($_SESSION['userType'] != 'U')){
    header('Location:..//restricted.html');
    die();
  }
  ?>
  <link rel="stylesheet" href="../css/styles.css">
  <meta charset="utf-8"/>
  <title>Find-the-Lost</title>
</head>
<body>

<div class="nav">
    <a class="active" href="../user/userHome.php">Home</a>
	<a href="../user/userItemDB.php">Lost Item Database</a>
	<a href="../user/userAddItem.php">Add Item</a>
    <a href="../user/userRequests.php">Request History</a>
	<a href="../user/userMyAccount.php">My Account</a>
    <a href="../logout.php">Logout</a>
</div>

<div style="padding-left:16px">
  <h2><center>Find the Lost</center></h2>
  <p><center>Your Account</center></p>
</div>

  <p><center><z>Welcome <?php echo $_SESSION['userName'] ?> </z></center>
  <h1><center>Your Request History</center></h1>
    <?php
	//db connection
	require_once("..//connection.php");

	$userName = $_SESSION['userName'];
	
	//find user requests
	$sql = "SELECT * FROM requests WHERE (userName = '$userName')";
	$result1 = mysqli_query($conn, $sql);
	if ($result1->num_rows > 0) {
	// output data of each row
	while($row1 = $result1->fetch_assoc()) {
	$itemID = $row1["itemID"];
	
	//find item details
	$sql2 = "SELECT * FROM items WHERE (itemID = '$itemID')";
	$result2 = mysqli_query($conn, $sql2);
	$row2 = $result2->fetch_assoc();
    echo "Item Requested: " . $row1["itemID"]. "   Date Made: ".$row1["dateRequested"]."  Approval Status: " .$row1["status"];	

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
  <form action="userRequests.php" method="POST">
  <input type="hidden" name="requestID" value="<?= $row1['requestID'] ?>" >
  <input type="submit" name="submit" value="Delete request" />
  <br></br>
  </form>
</div>
</div>

<script>
//collapsible script to view item details
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
}
} else {
?></p><center>No requests found.</center></p><?php
}

if(isset($_POST['submit'])){
	$sql3 = "DELETE FROM requests WHERE (requestID = '$_POST[requestID]')";

if ($conn->query($sql3) === TRUE) {
    echo "Request deleted successfully";

} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
}


require_once("..//footer.html");

?>
</body>
</html>
