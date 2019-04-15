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

<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}
if(!isset($_GET['id'])){
	header('Location: index.php');
}

if(isset($_POST['edit'])){
	$sid = $_POST['sid'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$edit = "UPDATE posts SET title='$title', content='$content' WHERE id=$sid";

    if ($con->query($edit) === TRUE) {
        echo "Post updated successfully";
    } else {
        echo "Error updating post: " . $con->error;
    }
}

$id = $_GET['id'];

$sel = "SELECT title, content FROM posts WHERE id=$id";
$result = $con->query($sel);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$gtitle = $row['title'];
		$gcontent = $row['content'];
    }
} else {
    header('Location: index.php');
}

?>

<a href="index.php">Return Home</a><br><br>
<form method="post" action="">
  <input type="hidden" value="<?php echo $id; ?>" name="sid">
  <input type="text" name="title" placeholder="Title of the Post" value="<?php echo $gtitle; ?>"><br><br>
  <textarea name="content" placeholder="Post Content (HTML Allowed)" style="height:700px;"><?php echo $gcontent; ?></textarea><br><br>
  <input type="submit" value="Add Post" name="edit" class="add">
</form>