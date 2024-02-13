


<div class="content">
        <h2> Update Department <?= $model->name ?></h2>
        <div class="container">
            <form action="/department-update?id=<?= $model->id ?>" method="post">
                <div class="mb-3">
                    <label for="departmentName" class="form-label">Name</label>
                    <input type="hidden" name="id" value="<?= $model->id ?>" >
                    <input type="text" class="form-control" id="departmentName" aria-describedby="emailHelp" name="name" value="<?= $model->name ?>">
                    <?= $model->printErrorMessage('name') ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>
