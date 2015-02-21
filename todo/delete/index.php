<?php
include '../../generic/db.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if( isset($_GET['id']) && isset($_GET['action'])){
    $idd = $_GET['id'];
    $action = $_GET['action'];
    //print $action." ".$id;
    switch($action){
    case 'complete':
        $sql = "UPDATE ToDo SET Completed=1 WHERE id=$idd";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        break;
    case 'uncomplete':
        $sql = "UPDATE ToDo SET Completed=0 WHERE id=$idd";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        break;
    default:
        print "INVALID ACTION";
        break;
    }
}else{
    print var_dump($_GET);
    print 'no data';
}

?>
