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
                        <li class="breadcrumb-item">Add</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

     
    <section id="basic-horizontal-layouts">
        <div class="row match-height"> 
            <div class="col-md-12 col-12">
                <div class="card"> 
                    <div class="card-content">
                        <div class="card-body">
                            
                            <form class="form form-horizontal" action="<?=base_url()?>/musers/user/resource" method="POST">
                                <div class="form-body row  p-0 m-0"> 
                                    <div class="col-sm-6 row   p-0 m-0">
                                        <div class="col-md-3 mt-2">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-8">
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


                                        <div class="col-md-3 mt-2">
                                            <label>Username</label>
                                        </div>
                                        <div class="col-md-8">
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

                                        <div class="col-md-3 mt-2">
                                            <label>Password</label>
                                        </div>
                                        <div class="col-md-8">
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
                                    <div class="col-sm-6 row m-0 p-0"> 
                                        <div class="col-md-3 mt-2">
                                            <label>Pengguna</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative"> 
                                                    <select name="pengguna" class="form-select  <?= ($data['validation']->hasError('pengguna')) ? 'is-invalid' :'' ?>">
                                                        <option value="">~ Pilih Level Pengguna</option>
                                                        <?php foreach ($data['q_auth_groups'] as $value) : ?> 
                                                            <option value="<?=$value->id?>" <?= (old('pengguna') == $value->id) ? 'selected' : '' ?>><?=$value->description?></option>
                                                        <?php endforeach;?>
                                                    </select> 
                                                </div> 
                                                <small class="text-danger text-capitalize"> 
                                                    <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('pengguna')) ?>
                                                </small>
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

                   

                                        <!--warning theme Modal -->
                                        <div class="modal fade text-left " id="warningmssg" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel140" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title white" id="myModalLabel140">Warning Modal
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tart lemon drops macaroon oat cake chocolate toffee chocolate
                                                        bar icing. Pudding jelly beans
                                                        carrot cake pastry gummies cheesecake lollipop. I love cookie
                                                        lollipop cake I love sweet
                                                        gummi bears cupcake dessert.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>

                                                        <button type="button" class="btn btn-warning ml-1"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Accept</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





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


