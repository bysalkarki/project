<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mt-3">
            <div class="card">
                <div class="card-header">
                    Add Attendance for <?= $employee->name ?>
                </div>
                <div class="card-body">
                    <form action="/attendance?employee_id=<?= $employee->id ?>" method="post">
                        <div class="mb-3">
                            <input type="hidden" name="employee_id" value="<?= $employee->id ?>">
                            <label for="departmentName" class="form-label">Name</label>
                            <input type="date" class="form-control" aria-describedby="emailHelp" name="attendance_date"
                                   value="<?= $model->attendance_date ?>">
                            <?= $model->printErrorMessage('attendance_date') ?>
                        </div>

                        <div class="mb-3">
                            <label for="departmentName" class="form-label">status</label>
                            <select name="status" class="form-select" >
                                <option value="1"> Present</option>
                                <option value="0"> Absent</option>
                            </select>
                            <?= $model->printErrorMessage('status') ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Attendance</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Attendance Record</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($models as $key => $attendance) {
                    ?>
                    <tr>
                        <th scope="row"><?= ++$key ?></th>
                        <td><?= $attendance->attendance_date ?></td>
                        <td><?= $attendance->status ? 'Present' : 'Absent'?></td>
                    </tr>
                    <?php
                } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

