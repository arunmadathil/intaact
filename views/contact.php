<?php

?>

<form method="POST" action="/contact">
  <h3>Contact</h3>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="first_name" value = "" placeholder="Enter first name.">
    <?php
    if (!empty($errors['first_name']))
      foreach ($errors['first_name'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>

  <div class="form-group mt-2">
    <label for="exampleInputPassword1">Last Names</label>
    <input type="text" class="form-control" name="last_name" value = "" placeholder="Last name">
    <?php
    if (!empty($errors['last_name']))
      foreach ($errors['last_name'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>

  <div class="form-group mb-2">
    <label for="exampleInputPassword1">DOB </label>
    <input type="date" class="form-control" name="dob" value = "" placeholder="Enter date of birth!">
  </div>
  <br>

  <div class="form-group mb-2">
    <label for="exampleInputPassword1">Contact No </label>
    <input type="text" class="form-control" name="contact_no" placeholder="Enter contact number!">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>

  <?php
  error_log(print_r($errors, 1));
  ?>
</form>