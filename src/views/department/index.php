<div class="container">
  <div class="row">
      <div class="col-8">
          <table class="table table-striped">
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
                              <form action="/department/delete" method="post" class="h-100">
                                  <input type="hidden" name="id" value="<?= $department->id ?>">
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
      <div class="col-4">
          <h2> Create Department </h2>
          <div class="container">
              <form action="/department" method="post">
                  <div class="mb-3">
                      <label for="departmentName" class="form-label">Name</label>
                      <input type="text" class="form-control" id="departmentName" aria-describedby="emailHelp" name="name" value="<?= $model->name ?>">
                      <?= $model->printErrorMessage('name') ?>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
      </div>
  </div>
</div>
