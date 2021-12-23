<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-8 px-1">
        <form class="form" method="" action="">
            <div class="card ">
                <div class="card-header ">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profile</h4>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?= $profile['username']; ?>">
                            </div>
                        </div>
                        <div class="col-md-5 pl-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $profile['email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 pr-1">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" placeholder="Company" name="fullname" value="<?= $profile['fullname']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" name="phone" value="<?= $profile['phone']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>IDTelegram</label>
                                <input type="text" class="form-control" placeholder="IDTelegram" name="id_telegram" value="<?= $profile['id_telegram']; ?>">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-group mb-3 ml-2">
                            <input type="text" class="form-control" placeholder="Select picture profile" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Browse</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill pull-right ml-2">Update Profile</button>

                </div>
            </div>
        </form>

    </div>
    <div class="col-lg-4">
        <div class="card card-user">
            <div class="card-body text-center ">
                <div class="author">
                    <span href="#">
                        <img class="rounded-circle " style="max-width:200px" src="img/profile/2011004774.jpg" alt="...">
                        <h5 class="card-title mt-3"><?= $profile['fullname']; ?></h5>
                    </span>
                    <p class="card-description">
                        <?= $profile['username']; ?>
                    </p>
                </div>
                <p class="card-description text-center">
                    Hey there! As you can see,
                    <br> it is already looking great.
                </p>
            </div>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>