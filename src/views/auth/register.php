<?php

?>
<h1>Register</h1>
<div class="container">
    <form action="/registration" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $model->name ?>">
            <?= $model->printErrorMessage('name') ?>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $model->email ?>">
            <?= $model->printErrorMessage('email') ?>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            <?= $model->printErrorMessage('password') ?>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password Confirmation</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="passwordConfirmation">
            <?= $model->printErrorMessage('passwordConfirmation') ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>