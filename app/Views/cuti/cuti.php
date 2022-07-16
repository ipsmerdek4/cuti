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
                <h3>Manage Cuti</h3>
                <br>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Manage Cuti</li> 
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
                            <div class="d-flex justify-content-center justify-content-lg-start ">

                                <a href="<?=base_url()?>/mcuti/add" class="btn btn-primary  mt-2 mt-lg-2 mb-4 me-lg-4 ">
                                    <i class="bi bi-newspaper"></i> 
                                    <span> Pengajuan Cuti</span>
                                </a>

                                <?= (in_groups('administrator') == true) ? '  
                                        <a href="#" class="btn btn-danger  mt-2 mt-lg-2 mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            <i class="bi bi-newspaper"></i> 
                                            <span> Kategori Cuti</span>
                                        </a>
                                ' : '' ?> 
                            </div>
                            <table id="tableSO" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Employee</th> 
                                        <th>Categori Cuti</th> 
                                        <th>Tanggal Pengajuan</th> 
                                        <th>Tanggal Berakhir</th> 
                                        <th>Deskripsi</th>  
                                        <th>Status</th>
                                        <?= (in_groups('administrator') == true) ? '<th>opsi</th>' : '' ?> 
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>



                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Kategori Cuti</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <button class="btn btn-danger mt-2 mt-lg-2 mb-4 pb-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" data-bs-dismiss="modal"> 
                                            <div class="float-start">                                            
                                                <i class="bi bi-node-plus " style="font-size: 20px; margin-bottom: -20px; padding-bottom: 0px;"></i> 
                                            </div>
                                            <span class="float-start ms-2"> Kategori Cuti</span>
                                        </button>              
                                        <div class="table-responsive">
                                        <table id="tableSPC" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name Kategori</th>  
                                                    <th>Max Day Kategori</th>  
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; foreach ($data['getCategoriCuti'] as $value) : $no++; ?>
                                                    <tr>
                                                        <td><?=$no?></td>
                                                        <td><?=$value->nama_categori_cuti?></td>
                                                        <td><?=$value->max_categori_cuti?></td>
                                                        <td> 
                                                            <div class="form-check form-switch d-flex justify-content-center">
                                                                <input class="form-check-input statuscategori" data-id="<?=$value->id_categori_cuti?>" data-sts="<?=$value->status_categori_cuti?>" type="checkbox" <?=($value->status_categori_cuti == 1) ? 'checked' : '' ?> > 
                                                            </div>
 
                                                        </td>
                                                    </tr>      
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>    
                                        </div> 

                                    </div> 
                                    </div>
                                </div>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori Cuti</h5>
                                            <button class="btn-close" data-bs-target="#staticBackdrop" data-bs-toggle="modal" data-bs-dismiss="modal"></button>

                                        </div>
                                        <form action="<?=base_url()?>/mcuti/categori/add" method="post">
                                            <div class="modal-body">

                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Nama Katagori</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control <?= ($data['validation']->hasError('nama_categori_cuti')) ? 'is-invalid' :'' ?>" placeholder="Nama Kategori" value="<?= old('nama_categori_cuti')?>" name="nama_categori_cuti">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-border"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize">  
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('nama_categori_cuti')) ?>
                                                    </small>
                                                </div> 

                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Max Day Katagori</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control <?= ($data['validation']->hasError('max_categori_cuti')) ? 'is-invalid' :'' ?>" placeholder="Max Day Katagori" value="<?= old('max_categori_cuti')?>" name="max_categori_cuti">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-calendar-date"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger text-capitalize">  
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('max_categori_cuti')) ?>
                                                    </small>
                                                </div>
                                                
                                            </div>  
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" >Submit</button>
                                            </div>
                                        </form>
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
            <?php if (($data['validation']->hasError('nama_categori_cuti'))||($data['validation']->hasError('max_categori_cuti'))) : ?>
                $('#staticBackdrop2').modal('show');
            <?php endif; ?>

            <?php if (!empty(session()->getFlashdata('successmodal'))) : ?>    
                $('#staticBackdrop').modal('show');
            <?php endif; ?>


            /*  */


            var tablespc = $('#tableSPC').DataTable({  
                responsive: true, 
                columnDefs: [
                    { targets: 0, orderable: false, className: "text-center"},  
                    { targets: 1, className: "text-center"},
                    { targets: 2, className: "text-center"}, 
                    { targets: -1, orderable: false, className: "text-center"}, 
                ] 
            });
 
 
            $('#tableSO').DataTable({ 
                processing: true,
                serverSide: true,
                responsive: true,
                order: [], //init datatable not ordering
                ajax: "/mcuti/vcuti", 
                columnDefs: [
                    { targets: 0, orderable: false, className: "text-center"},  
                    { targets: 1, className: "text-center"},
                    { targets: 2, className: "text-center"},
                    { targets: 3, className: "text-center"},
                    { targets: 4, className: "text-center"},
                    { targets: 5, className: "text-center"}, 
                    { targets: -1, orderable: false, className: "text-center"},  
                    { targets: -2, orderable: false, className: "text-center"},  
                ] 
            });
 
 
        });


        
        
        $("#tableSO").on("click", "#approval", function (e) {
                e.preventDefault();
                const id = $(this).data("id");  
                const data = $(this).data("data");  

                Swal.fire({
                            title: "Info",
                            html:
                                "<div class='' style='font-size:15px;'>" +
                                "Are you sure, <b>Approve</b> this data?<br><br>" +
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
                                document.location.href = '/mcuti/approve/' + id;
                            }
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
                                document.location.href = '/mcuti/destroy/' + id;
                            }
                            });
 
        });


        $('.statuscategori').click(function (e) { 
                e.preventDefault(); 
                const ID = $(this).data("id"); 
                const sts = $(this).data("sts");

                if (sts == 1) {
                    $.ajax({
                        type: "POST",
                        url: "mcuti/categori/edit",
                        data: {ID:ID, sts:0 },
                        dataType: "json",
                        success: function (response) { 
                            if (response.msg == 'Success') {
                                location.reload();
                                $('#staticBackdrop').modal('show'); 
                            }  
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "mcuti/categori/edit",
                        data: {ID:ID, sts:1 },
                        dataType: "json",
                        success: function (response) { 
                            if (response.msg == 'Success') { 
                                location.reload(); 
                                $('#staticBackdrop').modal('show'); 
                            }  
                        }
                    });
                }

                  
                
            });
  






           
</script>



<?= $this->endSection() ?>


