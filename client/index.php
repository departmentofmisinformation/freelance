<?php
include '../generic/db.php';
if(isset($_GET['id'])){
    $idd =  $_GET['id'];
?>
<?php
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT id, Name FROM Client WHERE id=$idd";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
<h1><?php  echo $row["Name"]; ?></h1>
<a href="#" class="btn btn-danger pull-right" id="deleteClient" style="margin-left:10px;">Delete</a>
<a href='#' class="btn btn-info pull-right"  id='archiveClient' style='margin-left:10px;'>Archive</a>
<a href='#' class="btn btn-warning pull-right" style='margin-left:10px;'>Edit</a>
<a href='#/client/' class="btn btn-default pull-right">Back to Clients</a>
<br/>
<br/>
<br/>
<ul class="list-group">
<li class='list-group-item'><center><b>Projects for <?php echo $row['Name']; ?></b></center></li>
<?php
        $sql2 = "SELECT id, Name FROM Projects WHERE ClientID=".$row['id'];
        $res = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($res) > 0) {
            while($proj = mysqli_fetch_assoc($res)) {
                print "<li class='list-group-item'><a href='#/projects/".$proj['id']."/'>".$proj['Name']." </a></li>";
            }

        }else{
?>
<p>No projects.</p>
<?php
        }
?>
<br/>
<a class="btn btn-primary" href='#/projects/new/<?php echo $row['id']; ?>/' role="button">New Project</a>
<?php
    }
}else{
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT id, Name FROM Client";
    $result = mysqli_query($conn, $sql);
?>
<h1>Clients</h1>
<ul class="list-group">
<?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $sql2 = "SELECT id, Name FROM Projects WHERE ClientID=".$row['id'];
            $res = mysqli_query($conn, $sql2);
            $rowCount = mysqli_num_rows($res);
            print "<li class='list-group-item'><a href='#/client/".$row['id']."/'>".$row['Name']." </a><span class='badge'>".$rowCount."</span></li>";
        }
    }else{
        echo "<center><p>No Clients</p></center>";
    }
?>
</ul>
<a class="btn btn-primary" href="#/client/new/" role="button">New Client</a>
<?php
}
mysqli_close($conn);

?>
