<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}
if(!isset($_GET['id'])){
	header('Location: index.php');
}
$id = $_GET['id'];
$sql = "SELECT id, title FROM posts WHERE id=$id";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
		$title = $row['title'];
		echo "
		Do you really want to delete the post,<br>
		<b>$title</b> ?<br><br>
		<form method='post' action=''>
        <input type='submit' value='Yes. Delete.' name='delete'>
        </form>
		<a href='index.php'><input type='submit' value='No. Return Home.' name='home'></a>";
    }
} else {
    echo "No such post! It may be already deleted";
}
if (isset($_POST['delete'])){
	global $del;
	$del = "DELETE FROM posts WHERE id=$id";

    if ($con->query($del) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error deleting post: " . $con->error;
    }
}
?>