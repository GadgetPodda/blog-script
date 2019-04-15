<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Simple Blog Script</title>
  </head>
  <body>
<?php
if (!isset($_GET['id'])) {
	header("Location: index.php");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$title = $row['title'];
		$content = $row['content'];
		$date = $row['date'];
		$time = $row['time'];
		echo "
		<div id='post' style='border:2px solid black;'>
		<a href='view.php?id=$id'><h3>$title</h3></a>
		<p>$content</p>
		Posted on <i>$date</i> at <i>$time</i>
		";
    }
} else {
    echo "No Posts Found!";
}
$conn->close();
?>
  </body>
</html>