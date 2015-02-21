<?php
include '../../generic/db.php';
if(isset($_POST['name'])){
$name =  $_POST['name'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Client (Name)
VALUES ('$name')";

if (mysqli_query($conn, $sql)) {
 //   echo "New record created successfully";
    echo  "#/client/".mysqli_insert_id($conn)."/";

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
}
?>
