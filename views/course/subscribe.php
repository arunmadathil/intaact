<br>

<div class="row">
    <div class="col-md-12 ">
        <div class="text-center mb-4" style="margin-left: -150px;">
            <h4>Subscribe  Course</h4>
        </div>
    </div>
</div>

<form method="post" action="/subscribe-course/subscribe" class="form-card">
    <div class="row subscribe">
        <div class="col-sm-5">
            <div class="form-group">
                <label class="form-control-label px-3">Student<span class="text-danger"> *</span></label>
                <select name="course[]" class="form-control">
                    <option value="">Select Course</option>
                    <?php foreach ($courses as $course) : ?>
                        <option value="<?= $course['id'] ?>"><?= $course['course_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label class="form-control-label px-3">Course<span class="text-danger"> *</span></label>
                <select name="students[]" class="form-control" id="">
                    <option value="">Select Students</option>
                    <?php foreach ($students as $student) : ?>
                        <option value="<?= $student['id'] ?>"><?= ucfirst($student['first_name']) . " " . ucfirst($student['last_name'])  ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>
        <div class="col-sm-2 add_btn">
            <a class="btn btn-primary add" style="margin: auto; height: 35px; margin-top: 33px;" href="javascript:;"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="append"></div>

    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-2" style="margin-left: 424px;">
            <button class="btn btn-info">Submit</button>
        </div>
    </div>
</form>