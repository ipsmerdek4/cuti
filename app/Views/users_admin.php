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
                <h3>Manage Users</h3>
                <br>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Manage Users</li>
                        <li class="breadcrumb-item">User</li>
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
                            
                            <a href="<?=base_url()?>/admin/musers/user/add" class="btn btn-primary pt-2 mb-4"><i class="bi bi-person-plus "></i> <span>User</span></a>
                        
                            <table id="tableSO" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Create</th>
                                        <th>opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>


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
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/vendors/datatables/datatables.min.css"/> 
<?= $this->endSection() ?>

<!--  -->
<?= $this->section('javascript') ?>
            <script type="text/javascript" src="<?=base_url()?>/assets/vendors/datatables/datatables.min.js"></script>
 

<script>
        
        $(document).ready(function() {
 
            $('#tableSO').DataTable({ 
                processing: true,
                serverSide: true,
                responsive: true,
                order: [], //init datatable not ordering
                ajax: "vuser", 
                columnDefs: [
                    { targets: 0, orderable: false, className: "text-center"},  
                    { targets: 1, className: "text-center"},
                    { targets: 2, className: "text-center"},
                    { targets: 3, className: "text-center"},
                    { targets: 4, className: "text-center"},
                    { targets: -1, orderable: false, className: "text-center"},  
                ] 
            });
 
 
        });
           
</script>



<?= $this->endSection() ?>


