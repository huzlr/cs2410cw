<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    session_start();
	//if user type is not user, restrict access
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
    <a href="../user/userHome.php">Home</a>
	<a class="active" href="../user/userItemDB.php">Lost Item Database</a>
	<a href="../user/userAddItem.php">Add Item</a>
    <a href="../user/userRequests.php">Request History</a>
    <a href="../user/userMyAccount.php">My Account</a>
    <a href="../logout.php">Logout</a>
</div>

<div style="padding-left:16px">
  <p><center>Below you can find available items that have been found.</center></p>
  <p><center>View details then click request to claim your lost item!</center></p>
</div>

    <br>
    <h1><center>Items found</center></h1>
    <?php
    require_once("..//connection.php");

	//find available items
    $sql = "SELECT * FROM items WHERE (availability = 'available')";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		for($i = 1; $i <= result +1; $i++){
        echo  
		" \n Result $i: "
		. $row["category"].
		", " . $row["colour"].
		", found on " . $row["foundTime"];
		
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
    <td><img src="<?php echo $row['photo']; ?> "alt="Image" height="140" width="140"></td>
    <td><?php echo $row['category']; ?></td> 
    <td><?php echo $row['colour']; ?></td>
    <td><?php echo $row['foundTime']; ?></td>
    <td><?php echo $row['foundPlace']; ?></td>
    <td><?php echo $row['description']; ?></td>
  </tr>
</table>

<div class="form">
  <form action="userItemDB.php" method="POST">
    <b>
   <br>Enter the reason of your request:<br>
   <input type="text" name="reason" placeholder="Enter reason" required>
   </b>
  <br>
  <input type="hidden" name="itemID" value="<?= $row["itemID"] ?>" >
  <input type="submit" name="submit" value="Request Item" />
  <br></br>
  </form>
  </div>
</div>
<script>
//collapsible to view item details
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
	}
} else {
    echo "<p align=center> No items found! </p> ";
}

if(isset($_POST['submit'])){
	$userName = $_SESSION['userName'];
	$sql2 = "INSERT INTO requests(userName, itemID, reason, dateRequested, status)
	VALUES('$userName','$_POST[itemID]', '$_POST[reason]', now(), 'pending')";


if ($conn->query($sql2) === TRUE) {
    echo "Request created successfully";

} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
}

require_once("..//footer.html");

  ?>
</body>
</html>
