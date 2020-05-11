<!DOCTYPE html>
<html lang="en">
<head>
  <?php session_start();
  //if user type is not user, restrict access
  if(($_SESSION['userType'] != 'U')){
    header('Location:..//restricted.html');
    die();
  } ?>
  <link rel="stylesheet" href="../css/styles.css">
  <meta charset="utf-8"/>
  <title>Find-the-Lost Add item</title>
</head>
<body>
  <div class="nav">
    <a href="../user/userHome.php">Home</a>
	<a href="../user/userItemDB.php">Lost Item Database</a>
	<a class="active" href="../user/userAddItem.php">Add Item</a>
    <a href="../user/userRequests.php">Request History</a>
	<a href="../user/userMyAccount.php">My Account</a>
    <a href="../logout.php">Logout</a>

  </div>

  <div style="padding-left:16px">
    <h2><center>Found an item?</center></h2>
  </div>
  <center><p>Fill out the item information below to add the item</p></center>
  <div class ="form">
  <form action="userAddItem.php" method="POST" enctype="multipart/form-data">
    <b>
   <br>Select Category:<br>
	<select id="category" name="category">
    <option value="Pet">Pet</option>
    <option value="Phone">Phone</option>
    <option value="Jewellery">Jewellery</option>
	</select>
	
   <br>Time found:<br>
   <input type="datetime-local" name="foundTime" placeholder="Time found?" required>
   <br>Place found:<br>
   <input type="text" name="foundPlace" placeholder="Place found?" required>
   <br>Colour:<br>
   <input type="text" name="colour" placeholder="Colour" required>
   <br>Description:<br>
   <input type="text" name="description" placeholder="Description" required>
   <br>Select image to upload:</br>
   <input type="file" name="fileToUpload" id="fileToUpload" required>
   <br></br>
  <input type="submit" name="submit" value="submit" />
  </form>
  </div>
  <?php
  require_once("..//connection.php");
	if(isset($_POST['submit'])){
	$userName = $_SESSION['userName'];

	$sanitizedFoundPlace = filter_var($_POST[foundPlace], FILTER_SANITIZE_STRING);
	$sanitizedFoundTime = filter_var($_POST[foundTime], FILTER_SANITIZE_STRING);
	$sanitizedColour = filter_var($_POST[colour], FILTER_SANITIZE_STRING);
	$sanitizedDescription = filter_var($_POST[description], FILTER_SANITIZE_STRING);
	
	
	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	//check if file is an image
	$check = getimagesize($_FILES['fileToUpload']["tmp_name"]);
	if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
	} else {
    echo "File is not an image.";
    $uploadOk = 0;
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your image file.";
  }
}
	
	$sql = "INSERT INTO items (`category`, `foundTime`, `foundUser`, `foundPlace`, `colour`, `photo`, `description`, `availability`) VALUES
			('$_POST[category]', '$sanitizedFoundTime', '$userName', '$sanitizedFoundPlace', '$sanitizedColour', '$target_file', '$sanitizedDescription', 'available')";
	
	
	if ($conn->query($sql) === TRUE) {
    echo "Item added successfully";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	}
	
	require_once("..//footer.html");
?>
</body>
</html>
