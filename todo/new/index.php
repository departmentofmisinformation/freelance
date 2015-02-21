<?php
if(!isset($_GET['id']))
    die();
$idd = $_GET['id'];
?>
<form class="form-horizontal" id='newProject' action="todo/submit/index.php">
<fieldset>

<!-- Form Name -->
<legend>New Todo Item</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="Name">Item</label>
  <div class="controls">
    <input id="Name" name="Name" type="text" placeholder="Title" class="form-control input-xlarge" required="">

  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="Message">Description</label>
  <div class="controls">
    <textarea class='form-control' id="Message" name="Message"></textarea>
  </div>
</div>
<input type='hidden' name='id' value='<?php echo $idd; ?>'>
<br/>
<a style='margin-right:5px;' class="btn btn-warning" href="#/projects/<?php echo $idd; ?>/" role="button">Cancel</a>
<input class="btn btn-primary" type="submit" value="Submit">
</fieldset>
</form>

