<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($students as $student):?>
        <tr>
            <th scope="row"><?=$student['id']?></th>
            <td><?=$student['first_name']?></td>
            <td><?=$student['last_name']?></td>
            <td> <a href="/student/edit/<?=$student['id']?>">  edit <i class="fa fa-pencil" aria-hidden="true"></i> </a>  </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>