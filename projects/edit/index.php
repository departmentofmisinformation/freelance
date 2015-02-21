<?php 
if(isset($_GET['id'])){
include '../../generic/db.php';
$idd = $_GET['id'];
}else{
die();
}
?>
<?php
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT id, Name FROM Projects WHERE id=$idd";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
?>
<h1>Now editing <?php echo $row['Name']; ?></h1>
<?php
}
?>
<a href='#'>Save</'a> |
<a href='#'>Cancel</'a>
