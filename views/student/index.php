</br>
<div class="col d-flex justify-content-center">
  <h2>Students</h2>
</div>
<div class="row">
  <div class="col-3 ml-auto"><a class="btn btn-info" href="/student/register">Register</a></div>

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
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col" style="width: 150px;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($students as $key => $student) : ?>
      <tr>
        <th scope="row"><?= $key + 1 ?></th>
        <td><?= $student['first_name'] ?></td>
        <td><?= $student['last_name'] ?></td>
        <td>

          <a class="btn btn-info" href="/student/edit/<?= $student['id'] ?>">  <i class="fa fa-pencil" ></i> </a>
          <a class="btn btn-danger" href="/student/delete/<?= $student['id'] ?>">  <i class="fa fa-trash"></i> </a>

        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $pagination ?>