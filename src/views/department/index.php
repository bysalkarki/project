<div class="container">
  <div class="row">
      <div class="col-12 mb-3 mt-3">
          <div class="card">
              <div class="card-header">
                  Add Department
              </div>
              <div class="card-body">
                      <form action="/department" method="post">
                          <div class="mb-3">
                              <label for="departmentName" class="form-label">Name</label>
                              <input type="text" class="form-control" id="departmentName" aria-describedby="emailHelp" name="name" value="<?= $model->name ?>">
                              <?= $model->printErrorMessage('name') ?>
                          </div>
                          <button type="submit" class="btn btn-primary">Add Department</button>
                      </form>
              </div>
          </div>
      </div>

      <div class="col-12">
          <table class="table table-striped table-hover">
              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Created_at</th>
                  <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach ($models as $key => $department) {
                  ?>
                  <tr>
                      <th scope="row"><?= ++$key ?></th>
                      <td><?= $department->name ?></td>
                      <td><?= $department->created_at ?></td>
                      <td>
                          <div class="d-flex align-item-center">
                              <a href="/department-update?id=<?= $department->id ?>" class="btn btn-primary btn-sm h-100">Edit</a>
                              <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="<?= $department->id ?>">
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
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/department/delete" method="post">
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
