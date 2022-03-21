<?php

?>
</br>
<div class="row">
<form method="POST" action="/course/store">
    <?=csrf_token()?>
  <h4>Create Course</h4>
  <div class="form-group">
    <label>Course Name</label>
    <input type="text" class="form-control" name="course_name" value = "<?= old($request->course_name);?>" placeholder="Enter course name.">
    <?php
    if (!empty($errors['course_name']))
      foreach ($errors['course_name'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>

  <div class="form-group mt-2">
    <label for="exampleInputPassword1">Course Details</label>
    <textarea name="course_details" id="" class="form-control" cols="30" rows="5"><?= old($request->last_name);?></textarea>
    <?php
    if (!empty($errors['course_details']))
      foreach ($errors['course_details'] as $message) {
        echo "<label style='color:red'> $message </label> </br>";
      }
    ?>
  </div>

  <br>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>
</div>