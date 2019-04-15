<?php
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "blog"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}


// Aditional Information (Changing isn't Very Important. But Highly Recommended.)

//////////////////////////////////////////////////////////////////////////////////

// Your Timezone (Default is Asia/Colombo). Visit https://www.php.net/manual/en/timezones.php to know what timezones are accepted.
$timezone = "Asia/Colombo";


?>