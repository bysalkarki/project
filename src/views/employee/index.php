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
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="<?= $employee->id ?>">
                                Delete
                            </button>
                        </div>

                    </td>
                </tr>
                <?php
            } ?>

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/employee/delete" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Record</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record??
                    <input type="hidden" name="id" value="" id="id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
// Button that triggered the modal
            const button = event.relatedTarget
// Extract info from data-bs-* attributes
            const id = button.getAttribute('data-bs-id')
// If necessary, you could initiate an Ajax request here
// and then do the updating in a callback.

// Update the modal's content.
            const modalBodyInput = exampleModal.querySelector('#id')
            modalBodyInput.value = id
        })
    }
</script>
