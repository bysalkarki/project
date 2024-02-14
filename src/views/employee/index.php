<div class="container">
    <h1>Employee</h1>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <td><a type="button" href="/employee/create" class="btn btn-primary">Create Employee</a></td>
            </tr>
            </thead>
            <thead>
            <tr class="text-capitalize">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Email</th>
                <th scope="col">address</th>
                <th scope="col">Created At</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($models as $key => $employee) {
                ?>
                <tr>
                    <th scope="row"><?= ++$key ?></th>
                    <td><?= $employee->name ?></td>
                    <td><?= $employee->position ?></td>
                    <td><?= $employee->email ?></td>
                    <td><?= $employee->address ?></td>
                    <td><?= $employee->created_at ?></td>
                    <td>
                        <div class="d-flex align-item-center">
                            <a type="button" href="/employee-update?id=<?= $employee->id ?>"
                               class="btn btn-primary btn-sm h-100">Edit</a>
                            <form action="/employee/delete" method="post">
                                <input type="hidden" name="id" value="<?= $employee->id ?>">
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>
                <?php
            } ?>

            </tbody>
        </table>
    </div>
</div>
