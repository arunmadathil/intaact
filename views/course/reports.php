</br>

<div class="col d-flex justify-content-center">
    <h2>Report</h2>
</div>
<div class="row">

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
            <th scope="col">Student Name</th>
            <th scope="col">Course Name</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        foreach ($reports as $report) : ?>
            <tr>
                <th scope="row"><?= $count += 1 ?></th>
                <td><?= $report['full_name'] ?></td>
                <td><?= $report['course_name'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pagination ?>