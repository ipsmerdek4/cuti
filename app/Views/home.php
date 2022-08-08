<?= $this->extend('Layout/app') ?> 
<?= $this->section('title') ?>
    <title><?=$data['title']?></title>
<?= $this->endSection() ?>
<!--  -->
<?= $this->extend('Layout/app') ?> 
<?= $this->section('content') ?>


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <br>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-sm-end ">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item "><a href="<?=base_url()?>"  >Dashboard</a></li> 
                    </ol>
                </nav>
            </div>
        </div>
    </div>

     
    <section id="basic-horizontal-layouts">


    <div class="row">
                <!-- <div class="col-12 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Login in Days</h6>
                                    <h6 class="font-extrabold mb-0"><?=$data['count_login_indays']?> User</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-12 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Employee</h6>
                                    <h6 class="font-extrabold mb-0"><?=$data['count_employee']?> Person</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Add Cuti in Days</h6>
                                    <h6 class="font-extrabold mb-0"><?=$data['count_cuti']?> Employee</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>



        <div class="row match-height"> 
            <div class="col-md-12 col-12">
                <div class="card"> 
                    <div class="card-content">
                        <div class="card-body">
                           
                        <h1 class="fs-1 text-center mt-5">WELCOME SISTEM CUTI ONLINE </h1>
                        <p class="text-center mb-5 mt-5">Untuk Memulai silahkan pilih menu di sebalah kiri.</p>
                                    

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     
     
</div>
 







<?= $this->endSection() ?>