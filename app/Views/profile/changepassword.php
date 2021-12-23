<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <div class="card col-lg-7">
        <?php echo session()->getFlashdata('message'); ?>
        <form action="profile/change" method="post">
            <div class="form-group row mt-4">
                <label class="col-sm-3 control-label" for="current_password">Current Password</label>
                <input type="password" class="col-sm-6 form-control" id="current_password" name="current_password">

            </div>
            <div class="form-group row mt-4">
                <label class="col-sm-3 control-label" for="new_password1">New Password</label>
                <input type="password" class="col-sm-6 form-control" id="new_password1" name="new_password1">

            </div>
            <div class="form-group row mt-4">
                <label class="col-sm-3 control-label" for="new_password2">Repeat Password</label>
                <input type="password" class="col-sm-6 form-control" id="new_password2" name="new_password2">

            </div>


            <div class="row justify-content-end mb-3">
                <div class="col-lg-9 px-0">
                    <button type="submit" class="btn btn-primary" id="btn-aksi">Save changes</button>
                </div>
            </div>
        </form>
    </div>


</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>