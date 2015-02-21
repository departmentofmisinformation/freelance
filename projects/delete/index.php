<?php
include '../../generic/db.php';
if(isset($_POST['id'])&&isset($_POST['action'])){
    $idd = $_POST['id'];
    $action = $_POST['action'];
    switch($action){
    case 'delete':
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // sql to delete a record
        $sql = "DELETE FROM ToDo WHERE ProjectID=$idd";

        if (mysqli_query($conn, $sql)) {
            $sql = "DELETE FROM Projects WHERE id=$idd";
            if (mysqli_query($conn, $sql)) {
                echo "#/projects/";
            } else {
                echo "FAIL";
            }
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        break;
    default:
        echo 'nothing to do';
        break;
    }
}

?>
