<?php

use Config\Validation;
?>
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
                <h3>Edit Pegawai</h3>
                <p class="text-subtitle text-muted">Silahkan isi Form dibawah ini dengan sebenar-benarnya.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url()?>/musers/pegawai">Manage Users</a></li>
                        <li class="breadcrumb-item">Edit Pegawai</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>



        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" action="<?=base_url()?>/musers/pegawai/update/<?=$data['ID']?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control  <?= ($data['validation']->hasError('name_employee')) ? 'is-invalid' :'' ?>" placeholder="Nama Lengkap" value="<?=$data['getemployee'][0]->full_name_pegawai ?>"  name="name_employee">
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('name_employee')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Number HP/WhatsApp</label>
                                                <div class="form-group has-icon-left ">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control <?= ($data['validation']->hasError('number_employee')) ? 'is-invalid' :'' ?>" placeholder="+62 Number" value="<?=$data['getemployee'][0]->number_pegawai ?>"  name="number_employee">
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-phone-fill"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize "> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('number_employee')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control <?= ($data['validation']->hasError('jabatan_employee')) ? 'is-invalid' :'' ?>" placeholder="Jabatan (Pegawai)" value="<?=$data['getemployee'][0]->jabatan_pegawai ?>"  name="jabatan_employee">
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-bag-fill"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('jabatan_employee')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Alamat</label> 
                                                <textarea name="alamat_employee" id="" class="form-control <?= ($data['validation']->hasError('alamat_employee')) ? 'is-invalid' :'' ?>" cols="10" rows="4" placeholder="Alamat Lengkap"><?=$data['getemployee'][0]->alamat_pegawai ?></textarea>
                                                <small class="text-danger text-capitalize">  
                                                    <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('alamat_employee')) ?>
                                                </small> 
                                            </div>
                                        </div> 
                                        <hr class="mt-5 border-top border-primary">
                                        <div class="col-12 row "> 
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>







 
    


</div>
 
<?= $this->endSection() ?>

<!--  --> 
<?= $this->section('styles') ?> 
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.min.css"/> 
<?= $this->endSection() ?>


<!--  -->
<?= $this->section('javascript') ?>  

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.min.js"></script>
<script>  

        
       
            <?php if (!empty(session()->getFlashdata('error'))) : ?>    
            Swal.fire({
                        title: 'Warning',
                        html: '<?php echo session()->getFlashdata('error'); ?>',
                        icon: 'warning', 
                    });
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('msg'))) : ?>    
            Swal.fire({
                        title: 'Success',
                        html: '<?php echo session()->getFlashdata('msg'); ?>',
                        icon: 'success', 
                    });
            <?php endif; ?> 
                                  
            

            $( "#chkpass" ).change(function() {
                var $input = $( this );
                if ($input.prop( "checked" ) == true) { 
                    $(".passhow").show();
                } else { 
                    $(".passhow").hide();
                }  
            }).change();
            
 
            
 
           
</script>



<?= $this->endSection() ?>


