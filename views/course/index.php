</br>
<div class="col d-flex justify-content-center">
  <h2>Courses</h2>
</div>
<div class="row">
  <div class="col-3 ml-auto"><a class="btn btn-info" href="/course/create">Create</a></div>

</div>
<br>
<div class="row">
  <?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success" role="alert">
      <?= $_SESSION['success'] ?>
      <?php unset($_SESSION['success']) ?>
    </div>
  <?php endif; ?>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Course Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($courses as $course) : ?>
      <tr>
        <th scope="row"><?= $course['id'] ?></th>
        <td><?= $course['course_name'] ?></td>
        <td>

          <a class="btn btn-info" href="/course/edit/<?= $course['id'] ?>"> <i class="fa fa-pencil"></i> </a>
          <a class="btn btn-danger" href="/course/delete/<?= $course['id'] ?>"> <i class="fa fa-trash"></i> </a>

        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $pagination ?>