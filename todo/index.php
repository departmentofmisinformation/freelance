<?php
include '../generic/db.php';
if(isset($_GET['id'])){
    $idd =  $_GET['id'];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //$sql = "SELECT * FROM ToDo WHERE id=$idd";
    $sql = "SELECT ToDo.Name as tName, ToDo.Message as Message,ToDo.Date as Date, ToDo.EndDate as EndDate, Projects.Name as pName FROM ToDo JOIN Projects ON ToDo.ProjectID = Projects.id WHERE ToDo.id=$idd";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
<h1><?php  echo $row["tName"]; ?></h1>
<span class="label label-default"><?php  echo $row["pName"]; ?></span>
<br/>
<br/>
<form id='newProject' action="todo/submit/index.php">
<h3><small> Title </small> </h3>
<input type='text' name='Name' class="form-control"  value='<?php echo $row['tName']; ?>' />
<h3><small> Information </small> </h3>
<textarea class="form-control"  name='Message' rows="3">
<?php echo $row['Message']; ?>
</textarea>
    <input type='hidden' name='id' value='<?php echo $idd; ?>'>
    <input type='hidden' name='update' value='true'>
<div class="row">
  <div class="col-md-6">

<h3><small> Begin Date </small> </h3>
<input type='text' name='date' class="form-control pickDate"  value='<?php echo $row['Date']; ?>' />
</div>
  <div class="col-md-6">

<h3><small> End Date </small> </h3>
<input type='text' name='enddate' class="form-control pickDate"  value='<?php echo $row['EndDate']; ?>' />
</div>
</div>
<br/>
<input class="btn btn-primary" type="submit" value="Submit">
</form>
<?php
        mysqli_close($conn);
    }
}else{
    echo 'todo';
}

?>
