<h1>Login</h1>
<div class="container">
    <form action="/login" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $model->email ?>">
            <?= $model->printErrorMessage('email') ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            <?= $model->printErrorMessage('password') ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>