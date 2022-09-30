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
                <h3>Tambah Cuti</h3>
                <p class="text-subtitle text-muted">Silahkan isi Form dibawah ini dengan sebenar-benarnya.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url()?>/mcuti">Manage Cuti</a></li>
                        <li class="breadcrumb-item">Add Cuti</li>
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
                                <form class="form" action="<?=base_url()?>/mcuti/resource" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Pilih Cuti</label>
                                                <div class="form-group has-icon-left ">
                                                    <div class="position-relative"> 
                                                        <select id="pilcutty" name="pilcutty" class="form-select">
                                                            <option value="">&raquo; Pilih Cuti</option>
                                                            <option value="1">&raquo; Cuti Tahunan</option>
                                                            <option value="2">&raquo; Cuti Khusus</option>
                                                        </select>  
                                                    </div>  
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label>Tanggal Pengajuan</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative"> 
                                                        <input type="date" class="form-control <?= ($data['validation']->hasError('tanggal_pengajuan_cuti')) ? 'is-invalid' :'' ?>" name="tanggal_pengajuan_cuti" value="<?=old('tanggal_pengajuan_cuti')?>" >
                                                        <div class="form-control-icon pb-1 mb-1">
                                                            <i class="bi bi-calendar-check"></i>
                                                        </div> 
                                                    </div>
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('tanggal_pengajuan_cuti')) ?>
                                                    </small>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Keterangan</label> 
                                                <textarea name="deskripsi_cuti"  class="form-control <?= ($data['validation']->hasError('deskripsi_cuti')) ? 'is-invalid' :'' ?>" cols="10" rows="4" placeholder="Deskripsi"><?=old('deskripsi_cuti')?></textarea>
                                                <small class="text-danger text-capitalize">  
                                                    <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('deskripsi_cuti')) ?>
                                                </small> 
                                            </div>
                                        </div> 
 

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Name Pegawai </label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative"> 
                                                        <select id="name_employee" name="name_employee" class="form-select name_employee  <?= ($data['validation']->hasError('name_employee')) ? 'is-invalid' :'' ?>">
                                                            <?php
                                                            if (in_groups('pegawai') == false) { ?>
                                                            <option value="">&raquo; Select Name Employee</option>
                                                            <?php } ?>
                                                            <?php foreach ($data['getEmployee'] as $value) : ?>
                                                                    <option value="<?=$value->id_employee ?>"  <?=(old('name_employee') == $value->id_employee) ? 'selected' : ''?>  >&raquo; <?=$value->full_name_pegawai?></option>
                                                            <?php endforeach; ?>
                                                        </select>  
                                                    </div> 
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('name_employee')) ?>
                                                    </small>
                                                </div>
                                            </div> 
                                            
                                            <div class="row">
                                                <div class="form-group col" id="tahunan1">
                                                    <label>Jumlah Cuti Tahunan </label>
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative"> 
                                                            <input  type="number" class="form-control" name="cuti_tahunan"   >
                                                            <div class="form-control-icon pb-1 mb-1">
                                                                <i class="bi bi-calendar-check"></i>
                                                            </div> 
                                                        </div>  
                                                    </div>
                                                </div> 

                                                <div class="form-group col" id="tahunan2">
                                                    <label>Sisa Cuti Tahunan </label>
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative"> 
                                                            <input id="sisa_cuti" readonly type="text" class="form-control " name="sisa_cuti"   >
                                                            <div class="form-control-icon pb-1 mb-1">
                                                                <i class="bi bi-calendar-check"></i>
                                                            </div> 
                                                        </div>  
                                                    </div>
                                                </div> 
                                            </div>

                                            <div class="form-group" id="khusus1">
                                                <label>Kategori Cuti Khusus</label>
                                                <div class="form-group has-icon-left ">
                                                    <div class="position-relative"> 
                                                        <select id="nameCategory" name="nama_Kategori" class="form-select nama_Kategori <?= ($data['validation']->hasError('nama_Kategori')) ? 'is-invalid' :'' ?>">
                                                            <option value="">&raquo; Pilih Nama Kategori</option>
                                                            
                                                            
                                                        </select>  
                                                    </div> 
                                                    <small class="text-danger text-capitalize "> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('nama_Kategori')) ?>
                                                    </small>
                                                </div>
                                            </div> 
                                            <div class="form-group" id="khusus2">
                                                <label>Lama Cuti</label>
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">  
                                                            <input id="tgl_pengajuan" type="text" class="form-control <?= ($data['validation']->hasError('lama_cuti')) ? 'is-invalid' :'' ?>" readonly name="lama_cuti" value="<?=old('lama_cuti')?>" >
                                                            <div class="form-control-icon pb-1 mb-1">
                                                                <i class="bi bi-calendar-check"></i>
                                                            </div> 
                                                    </div>  
                                                    <small class="text-danger text-capitalize"> 
                                                        <?=preg_replace("/[^a-zA-Z0-9]/", " ", $data['validation']->getError('lama_cuti')) ?>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                
 

<script>  

            $(document).ready(function () {
                $('#khusus1').hide();
                $('#khusus2').hide();
                $('#tahunan1').hide();
                $('#tahunan2').hide();
                
                $('#name_employee').prop('disabled', true);
            });

             $('#pilcutty').on('change', function() {

                $('#name_employee').prop('disabled', false);
                $("#pilcutty option[value='']").remove();
 
                let datas = this.value ;

                if (datas == 1) { 

                        
                        $('#khusus1').hide();
                        $('#khusus2').hide();
                        $('#tahunan1').show();
                        $('#tahunan2').show();  
  
                } else {

                    $('#khusus1').show();
                    $('#khusus2').show();
                    $('#tahunan1').hide();
                    $('#tahunan2').hide();

                   
                }
                
            });


    
            $('#name_employee').on('change', function() {

                let datas = $('#pilcutty').val(); ;

                if (datas == 1) {

                    let data = this.value ; //get data cost

                    if (data == "") {
                        $('#sisa_cuti').val('0');
                    }else{ 
                        
                        $('#khusus1').hide();
                        $('#khusus2').hide();
                        $('#tahunan1').show();
                        $('#tahunan2').show();
                            $.ajax({
                                type: "post",
                                url: "/mcuti/categori/view_check",
                                data: {data: data},
                                dataType: "json",
                                success: function (response2) { 
                                    $('#sisa_cuti').val(response2);
                                    if (response2 <= 0) { 
                                            $('#tahunan1').hide();
                                            
                                    }
                                }
                            });   
                    }
 

                } else {

                    $('.nama_Kategori').html(""); 

                    let data = $('#name_employee').val();   
                    $.ajax({
                                    type: "post",
                                    url: "/mcuti/categori/view_khusus_check",
                                    data: {data: data},
                                    dataType: "json",
                                    success: function (responseZ) {
                                        
                                        $('.nama_Kategori').append('<option value="">&raquo; Pilih Nama Kategori</option>');
                                        $.each(responseZ, function (indexInArray, valueOfElement) {  
                                            if (valueOfElement['id'] != "") { 
                                                $('.nama_Kategori').append('<option value="' + valueOfElement['id'] + '"> &raquo; ' + valueOfElement['values'] + '</option>');
                                            } 
                                        }); 
                                    }
                                });     


                }


                
            });  
 
             

            $('#nameCategory').on('change', function() {
                let data = this.value ;

                $.ajax({
                    type: "post",
                    url: "/mcuti/categori/view",
                    data: {data: data},
                    dataType: "json",
                    success: function (response) { 
                        $('#tgl_pengajuan').val(response.max_categori_cuti + " Day");
                    }
                });    
                
            });



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


