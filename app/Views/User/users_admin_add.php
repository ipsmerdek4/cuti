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
                <h3>Add User</h3>
                <p class="text-subtitle text-muted">Silahkan isi Form dibawah ini dengan sebenar-benarnya.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url()?>/musers/user">Manage Users</a></li>
                        <li class="breadcrumb-item">Add User</li>
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
                                <form class="form" action="<?=base_url()?>/musers/user/resource" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="email" class="form-control  <?= ($data['validation']->hasError('email_user')) ? 'is-invalid' :'' ?>" placeholder="Email" value="<?=old('email_user')?>"  name="email_user">
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('email_user')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <div class="form-group has-icon-left ">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control <?= ($data['validation']->hasError('full_name')) ? 'is-invalid' :'' ?>" placeholder="Full Name" value="<?=old('full_name')?>"  name="full_name">
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize "> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('full_name')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control <?= ($data['validation']->hasError('username')) ? 'is-invalid' :'' ?>" placeholder="Username" value="<?=old('username')?>"  name="username">
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('username')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control  <?= ($data['validation']->hasError('password')) ? 'is-invalid' :'' ?>" placeholder="Password" name="password">
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-lock"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('password')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Pengguna</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative"> 
                                                        <select name="pengguna" class="form-select  <?= ($data['validation']->hasError('pengguna')) ? 'is-invalid' :'' ?>">
                                                            <option value="">~ Pilih Level Pengguna</option>
                                                            <?php foreach ($data['q_auth_groups'] as $value) : ?> 
                                                                <?php if ($value->name != 'administrator') : ?>
                                                                    <option value="<?=$value->id?>" <?= (old('pengguna') == $value->id) ? 'selected' : '' ?>><?=$value->description?></option>
                                                                <?php endif;?>
                                                            <?php endforeach;?>
                                                        </select> 
                                                    </div> 
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('pengguna')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label> </label>
                                                <div class="form-group has-icon-left">
                                                    <div>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="chkverfikasi" name="chkverfikasi">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Hidupkan atau Matikan Verifikasi Email</label>
                                                        </div>
                                                    </div>    
                                                </div>
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
                                                         
           
</script>



<?= $this->endSection() ?>


