<div class="container-fluid h-90">
    <div class="row">
        <div class="col-md-6 login-image"></div>
        <div class="col-md-6 p-4">
            <div class="card ">
                <div class="card-title">
                    <h2 class="p-4">Login</h2>
                </div>
                <div class="card-body">
                    <form action="/login" method="post">
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   name="email" value="<?= $model->email ?>">
                            <?= $model->printErrorMessage('email') ?>
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            <?= $model->printErrorMessage('password') ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        </div>
    </div>
</div>