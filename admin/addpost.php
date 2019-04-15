<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Simple Blog Script</title>
	<style>
	.add{
    padding: 25px;
    width: 150px;
    background-color: dodgerblue;
    border: 0px;
    color: white;
    }
	input[type=text], textarea {
	border: 1px solid grey;
	border-radius: 5px;
	padding: 8px;
	width: 80%;
	}
	</style>
  </head>
  <body>
<?php
include "config.php";
date_default_timezone_set($timezone);

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$content = $_POST['content'];
	$t=time();
	$date = (date("Y-m-d",$t));
	$time = (date("H:i",$t));
	$sql = "INSERT INTO posts (id, title, content, date, time)
	VALUES (NULL, '$title', '$content', '$date', '$time')";

	if ($conn->query($sql) === TRUE) {
	    echo "New post created successfully";
	} else {
 	   echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>

<a href="index.php">Return Home</a><br><br>
<form method="post" action="">
  <input type="text" name="title" placeholder="Title of the Post"><br><br>
  <textarea name="content" placeholder="Post Content (HTML Allowed)" style="height:700px;"></textarea><br><br>
  <input type="submit" value="Add Post" name="submit" class="add">
</form>