<?php
include '../../generic/db.php';
$idd = isset($_GET['id'])?$_GET['id']:-1;
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT id, Name FROM Client";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
?>
<h1>New Project</h1>
<form id='newProject' action="projects/submit/index.php">
<h4>Name</h4>
<input name='name' class="form-control"  type='text'></input>
<h4>Client</h4>
<select class="form-control" name='client'>
    <?php
    while($row = mysqli_fetch_assoc($result)) {
        $sel = $row['id']==$idd?"selected='selected'":"";
        echo "<option value='".$row['id']."'".$sel.">".$row['Name']."</option>";
    }
}else{
    die("<h1 class='danger'> Add A Client first! </h1>");
}
?>
</select>
<br/>

<a style='margin-right:5px;' class="btn btn-warning" href="#/projects/" role="button">Cancel</a>
<input class="btn btn-primary" type="submit" value="Submit">
</form>

