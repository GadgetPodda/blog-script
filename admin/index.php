<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: ./index.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Simple Blog Script</title>
	<style>
	.logout{
    padding: 7px;
    width: 100px;
    background-color: tomato;
    border: 0px;
    color: white;
    }
	.add{
    padding: 7px;
    width: 100px;
    background-color: dodgerblue;
    border: 0px;
    color: white;
    }
	</style>
  </head>
  <body>
    <h1>Administration Homepage</h1>
    <form method='post' action="">
    <input type="submit" value="Logout" name="but_logout" class="logout">
    </form><br>
	<a href="addpost.php"><input type="submit" value="Add Post" name="add_post" class="add"></a>
	<br>
<?php
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
		$title = $row['title'];
		$date = $row['date'];
		$time = $row['time'];
		echo "
		<br>
		<div id='post'>
		<a href='../view.php?id=$id'><h3>$title</h3></a>
		Posted on <i>$date</i> at <i>$time</i><br><br>
		<a href='editpost.php?id=$id'>Edit Post</a> | <a href='deletepost.php?id=$id'>Delete Post</a>
		";
    }
} else {
    echo "No Posts Found!";
}
$conn->close();
?>
  </body>
</html>