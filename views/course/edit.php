<?php
$errors = $_SESSION['errors'];
$request = $_SESSION['request'];
unset($_SESSION['errors']);
unset($_SESSION['request']);
?>
</br>
<div class="row">

  <form method="POST" action="/course/update/<?= $id ?>">
    <h4>Create Course</h4>
    <div class="form-group">
      <label>Course Name</label>
      <input type="text" class="form-control" name="course_name" value="<?= old($request->course_name, $course->course_name); ?>" placeholder="Enter course name.">
      <?php
      if (!empty($errors['course_name']))
        foreach ($errors['course_name'] as $message) {
          echo "<label style='color:red'> $message </label> </br>";
        }
      ?>
    </div>

    <div class="form-group mt-2">
      <label for="exampleInputPassword1">Course Details</label>
      <textarea name="course_details" id="" class="form-control" cols="30" rows="5"><?= old($request->course_details, $course->course_details); ?></textarea>
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