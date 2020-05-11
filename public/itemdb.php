<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../css/styles.css">
  <meta charset="utf-8"/>
  <title>Find-the-Lost - Lost Item Database</title>
</head>
<body>

<div class="nav">
    <a href="../index.html">Home</a>
    <a class="active" href="../public/itemdb.php">Lost Item Database</a>
    <a href="../about.html">About Us</a>
    <a href="../register.php">Register</a>
    <a href="../login.php">Login</a>
</div>

<div style="padding-left:16px">
  <p><center>Below you can find available items that have been found.</center></p>
</div>

    <br>
    <h1><center>Items found</center></h1>
    <?php
	//connect to database
    require_once("../connection.php");

	//find available items
    $sql = "SELECT * FROM items WHERE (availability = 'available')";
    $result = mysqli_query($conn, $sql);

	//display each row of available items
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		for($i = 1; $i <= result +1; $i++){
        echo  
		" \n Result $i: "
		. $row["category"].
		", " . $row["colour"].
		", found on " . $row["foundTime"];
    }
	}
} else {
    echo "<p align=center> No items found! </p> ";
}
require_once("../footer.html");
  ?>
</body>
</html>
