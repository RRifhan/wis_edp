<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/css/styletodolist.css">

<div class="row">
    <div class="col-lg-7">
        <div class="card shadow border-left-primary">
            <div class="container">
                <div class="input-group mb-3 mt-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pilih Toko :</span>
                    </div>
                    <input type="text" class="form-control" id="pilihToko" list="listToko" value="">
                    <datalist id="listToko">
                        <?php
                        $this->db = \Config\Database::connect();
                        $tokos = $this->db->query('select * from tb_toko')->getResultobject();
                        foreach ($tokos as $toko) {
                            echo '<option value="' . $toko->KodeToko . '">' . $toko->KodeToko . ' - ' . $toko->NamaToko . '</option>';
                        }
                        ?>
                    </datalist>
                </div>
                <div id="hasil">
                    <label id="namatoko">Nama : <b>XXX - XXXXXXX</b></label><br>
                    <label>Koneksi Utama : <b>ASTINET</b> </label> <label class="ml-5">Koneksi Backup : <b>ASTINET</b> </label><br>
                    <label>No Telp : <b>08XXX</b> </label> <br>
                    <label>Alamat : <b>XXX</b> </label><br>
                    <label>ASPV : <b>XXX</b></label> <br>
                    <label>AMGR : <b>XXX</b></a> </label><br>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="TypeToko24">Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="TypeToko24" name="TypeToko24" value="">
                            <label class="custom-control-label" for="TypeToko24">Toko 24jam</label>
                        </div>
                        <div class="ml-2 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="TokoApka" name="TokoApka" value="">
                            <label class="custom-control-label" for="TokoApka">Toko Apka</label>
                        </div>
                        <div class="ml-2 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isIkiosk" name="isIkiosk" value="">
                            <label class="custom-control-label" for="isIkiosk">Ikiosk</label>
                        </div>
                    </div>
                    <div class="input-group mb-2 col-lg-8 ">
                        <div class="input-group-prepend">
                            <div class="input-group-text">IP Router</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" readonly value="10.42.xx">
                    </div>

                </div>



            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="list-wrapper border-left-danger">
            <h1 class="heading">Don't Forget To...</h1>
            <div class="add">
                <input class="txtAdd" type="text" placeholder="Add task here...">
                <button class="btnAdd" type="button">DELETE</button>
            </div>
            <div class="list">
            </div>
            <div class="switchMessage" ng-switch="allTasks">
                <h3 class="count">{{completedTasks}} out of {{taskList.length}} tasks completed</h3>
            </div>
        </div>
       
    </div>

</div>
</div>
<script src="<?= base_url('appjs/dashboard.js') ?>"></script>
<script src="<?= base_url('appjs/todolist.js') ?>"></script>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>