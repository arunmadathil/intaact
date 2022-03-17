<?php

?>

<form method="POST" action="/contact">
  <h3>Contact</h3>
  <div class="form-group">
    <label >First Name</label>
    <input type="text" class="form-control"  name ="first_name" placeholder="Enter first name.">
  </div>
  <div class="form-group mt-2">
    <label for="exampleInputPassword1">Last Names</label>
    <input type="password" class="form-control" name ="last_name" placeholder="Last name.">
  </div>
  <div class="form-group mb-2">
  <label for="exampleInputPassword1">Email </label>
    <input type="email" class="form-control"  name="email" placeholder="Enter email">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>