<?php

?>

<form method="POST" action="/student/store">
  <h4>Register</h4>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="first_name" value = "<?= old($request->first_name);?>" placeholder="Enter first name.">
    <?php
    if (!empty($errors['first_name']))
      foreach ($errors['first_name'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>

  <div class="form-group mt-2">
    <label for="exampleInputPassword1">Last Names</label>
    <input type="text" class="form-control" name="last_name" value = "<?= old($request->last_name);?>" placeholder="Last name">
    <?php
    if (!empty($errors['last_name']))
      foreach ($errors['last_name'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>

  <div class="form-group mb-2">
    <label for="exampleInputPassword1">DOB </label>
    <input type="text" class="form-control datepicker" name="dob" value = "<?=old($request->dob);?>" placeholder="Enter date of birth!">
    <?php
    if (!empty($errors['dob']))
      foreach ($errors['dob'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>
  <br>

  <div class="form-group mb-2">
    <label for="exampleInputPassword1">Contact No </label>
    <input type="text" class="form-control" name="contact_no" value="<?= old($request->contact_no);?>" placeholder="Enter contact number!">
  
    <?php
    if (!empty($errors['contact_no']))
      foreach ($errors['contact_no'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>