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

        $sql = "SELECT * FROM Projects WHERE ClientID=$idd";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $sql = "DELETE FROM ToDo WHERE ProjectID=".$row['id'];
            if (!mysqli_query($conn, $sql)) {
                die("FAIL 1");
            }
            }
        }
        $sql = "DELETE FROM Projects WHERE ClientID=".$idd;
        if (mysqli_query($conn, $sql)) {
            $sql = "DELETE FROM Client WHERE id=$idd";
            if (!mysqli_query($conn, $sql)) {
                die("FAIL 3");
            }
        } else {
            die("FAIL 2");
        }

        mysqli_close($conn);
        break;
    default:
        echo 'nothing to do';
        break;
    }
}

?>
