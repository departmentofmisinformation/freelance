<?php
include '../../generic/db.php';
if(isset($_POST['name'])&&isset($_POST['client'])){
$name =  $_POST['name'];
$client =  $_POST['client'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Projects (Name, ClientID)
VALUES ('$name', '$client')";

if (mysqli_query($conn, $sql)) {
 //   echo "New record created successfully";
    echo  "#/projects/".mysqli_insert_id($conn)."/";

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
}
?>
