<?php
include '../../generic/db.php';
if(isset($_POST['Name'])&&isset($_POST['id'])){
    $name =  $_POST['Name'];
    $projID = $_POST['id'];
    $message =  isset($_POST['Message'])?mysql_real_escape_String($_POST['Message']):"";
    $conn = new mysqli($servername, $username, $password, $dbname);
//    die(var_dump($_POST));
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_POST['update'])){
        $sql = "UPDATE ToDo SET Name='$name', Message='$message', Date='".$_POST['date']."', EndDate='".$_POST['enddate']."' WHERE id=".$projID;
    }else{
        $sql = "INSERT INTO ToDo (ProjectID, Message, Name)
            VALUES ('$projID', '$message', '$name')";
    }
        if (mysqli_query($conn, $sql)) {
            //   echo "New record created successfully";
            echo  "#/projects/".$projID."/";

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    mysqli_close($conn);
}else{
    print var_dump($_POST);
}

?>
