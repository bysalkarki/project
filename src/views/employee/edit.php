<h1>Update <?=$model->name ?></h1>
<div class="container">
    <form action="/employee-update" method="post">
        <input type="hidden" name="id" value="<?= $model->id ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name"
                   value="<?= $model->name ?>">
            <?= $model->printErrorMessage('name') ?>
        </div>


        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" aria-describedby="emailHelp" name="position"
                   value="<?= $model->position ?>">
            <?= $model->printErrorMessage('position') ?>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" class="form-control" id="salary" aria-describedby="emailHelp" name="salary"
                   value="<?= $model->salary ?>">
            <?= $model->printErrorMessage('salary') ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                   value="<?= $model->email ?>">
            <?= $model->printErrorMessage('email') ?>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label"> address</label>
            <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address"
                   value="<?= $model->address ?>">
            <?= $model->printErrorMessage('address') ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>