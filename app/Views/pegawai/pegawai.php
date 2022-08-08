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
                        <li class="breadcrumb-item">Pegawai</li>
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
                            
                            <a href="<?=base_url()?>/musers/pegawai/add" class="btn btn-primary pt-2 mb-4"><i class="bi bi-person-plus "></i> <span>Pegawai</span></a>
                        
                            <table id="tableSO" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th> 
                                        <th>Nomer HP/WhatsApp</th>
                                        <th>Jabatan</th>
                                        <th>Alamat</th>
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
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.min.css"/> 

<?= $this->endSection() ?>

<!--  -->
<?= $this->section('javascript') ?>
            <script type="text/javascript" src="<?=base_url()?>/assets/vendors/datatables/datatables.min.js"></script>
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




        
        $(document).ready(function() {
 
            $('#tableSO').DataTable({ 
                processing: true,
                serverSide: true,
                responsive: true,
                order: [], //init datatable not ordering
                ajax: "vpegawai", 
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



        $("#tableSO").on("click", "#delete", function (e) {
                e.preventDefault();
                const data = $(this).data("data"); 
                const id = $(this).data("id"); 

                Swal.fire({
                            title: "Info",
                            html:
                                "<div class='' style='font-size:15px;'>" +
                                "Are you sure, <b>Delete</b> this data?<br><br>" +
                                "<b>[ Nama => " +  data + " ]</b><br>" +  
                                "</div>",
                            icon: "info",
                            focusCancel: true,
                            showCancelButton: true,
                            cancelButtonText: "<i class='fa fa-times '></i> No",
                            confirmButtonText: "<i class='fa fa-check'></i> Yes",
                            buttonsStyling: false,
                            customClass: {
                                cancelButton: "btn btn-danger px-3",
                                confirmButton: "btn btn-primary me-3 px-3",
                            },
                            }).then((result) => {
                            if (result.value) {
                                document.location.href = '/musers/pegawai/destroy/' + id;
                            }
                            });
 
        });









           
</script>



<?= $this->endSection() ?>


