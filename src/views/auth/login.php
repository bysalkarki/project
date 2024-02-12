<?php

?>
<h1>Login</h1>
<div class="container">
    <form action="/login" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?= $model->name ?>">
            <?= $model->printErrorMessage('name') ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>