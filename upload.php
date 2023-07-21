<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "gexton";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["image"]))
{

 //Get the cropped image data
 $data = $_POST["image"];

 $image_array_1 = explode(";", $data);
 $image_array_2 = explode(",", $image_array_1[1]);
 $data = base64_decode($image_array_2[1]);
 $imageName = time() . '.png';
 file_put_contents($imageName, $data);
 echo '<img src="'.$imageName.'" class="img-thumbnail" />';



// Get the cropped image data
// $croppedImage = $_POST['image'];

// Save the cropped image to the database
$sql = "INSERT INTO images (image_data) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $data);
$stmt->execute();
$stmt->close();

$conn->close();

// Return a response to the client
echo "<p>Image uploaded and saved successfully!</p>";
}
?>

