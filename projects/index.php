<?php
include '../generic/db.php';
if(isset($_GET['id'])){
    // --------------------------[ VIEW SINGLE ] --------------------------
    $idd =  $_GET['id'];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT Projects.id as id, Projects.Name as pName, Client.Name as cName FROM Projects JOIN Client ON Projects.ClientID = Client.id WHERE Projects.id =$idd";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $todo = "SELECT * FROM ToDo WHERE ProjectID=".$row['id']." AND Completed=0";
        $todo2 = "SELECT * FROM ToDo WHERE ProjectID=".$row['id']." AND Completed=1";
        $res = mysqli_query($conn, $todo);
        $res2 = mysqli_query($conn, $todo2);
        $num = mysqli_num_rows($res);
        $num2 = mysqli_num_rows($res2);
?>
<h1><?php  echo $row["pName"]; ?></h1><span class='label label-default'><?php echo $row['cName']; ?></span>
<a href='#' class="btn btn-danger pull-right" id='deleteProject' style='margin-left:10px;'>Delete</a>
<a href='#' class="btn btn-warning pull-right" style='margin-left:10px;'>Edit</a>
<a href='#/projects/' class="btn btn-default pull-right">Back to Projects</a>
<br/>
<br/>
<br/>
<ul class="list-group">
<li class='list-group-item'><b>Items to do for <?php echo $row['cName']."'s ".$row['pName']; ?></b> </li>
<?php
        if ($num > 0) {
            while($todl = mysqli_fetch_assoc($res)) {
                print "<li class='list-group-item'  id='".$todl['id']."'><input class='todo-item' type='checkbox'>  <a class='pName' href='#/todo/".$todl['id']."/'>".$todl['Name']." </a> </li>";
            }
        }
        print "<span id='addHere'>";
        if ($num2 > 0) {
            print "<li class='list-group-item disabled'></li>";
            while($todl = mysqli_fetch_assoc($res2)) {
                print "<li class='list-group-item' id='".$todl['id']."' ><input class='todo-item' type='checkbox' checked><del> <a class='pName'  href='#/todo/".$todl['id']."/'>".$todl['Name']." </a> </del> </li>";
            }
        }
        if ($num2 == 0&&$num == 0) {
            print "<li class='list-group-item'>Nothing to do</li>";
        }
?>
</ul>
<a class="btn btn-danger" href="#/Projects/delete/" role="button">Delete completed items</a>
<a class="btn btn-primary"  id='addNewToDo'role="button">New Item</a>
<?php
    }else{
        echo 'nope';
    }
    // --------------------------[ VIEW ALL ] --------------------------
}else{
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT Projects.id as id, Projects.Name as pName, Client.Name as cName FROM Projects JOIN Client ON Client.Id = Projects.ClientID";
    $result = mysqli_query($conn, $sql);
?>
<h1>Projects</h1>
<ul class="list-group">
<?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $tod = "SELECT id FROM ToDo WHERE ProjectID = ".$row['id']." AND Completed=0";
            $res = mysqli_query($conn, $tod);
            $rowCount = mysqli_num_rows($res);
            print "<li class='list-group-item'>".
                "<span class='label label-default'>".$row['cName']."</span> ".
                "<a class='pName' href='#/projects/".$row['id']."/'>".
                $row['pName'].
                " </a> <span class='badge'>".$rowCount."</span></li>";
        }
    }
?>
</ul>
<a class="btn btn-primary" href="#/Projects/new/" role="button">Add New</a>
<?php
}
mysqli_close($conn);
?>
