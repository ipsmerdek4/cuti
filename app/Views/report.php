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
                <h3>Report Cuti</h3>
                <br>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-sm-end ">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li> 
                        <li class="breadcrumb-item">Report Cuti</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

     
    <section id="basic-horizontal-layouts">

 

        <div class="row match-height"> 
            <div class="col-md-6 col-12">
                <div class="card"> 
                    <div class="card-content">
                        <div class="card-body">
                       
                            <p>Pilih Tanggal di bawah ini :</p>

                            <div class="form-group"> 
                                <div class="form-group has-icon-left">
                                    <div class="position-relative"> 
                                        <input id='getdate' type="month" class="form-control " value="<?=date("Y-m")?>" >
                                        <div class="form-control-icon pb-1 mb-1">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                    </div>  
                                </div>
                            </div>

                            <hr class="mt-5 border border-primary">

                            <button id="cetak" class="btn btn-primary">Cetak</button>


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
      



<?= $this->endSection() ?>

<!--  -->
<?= $this->section('javascript') ?>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script>

    $('#cetak').click(function (e) { 
        e.preventDefault();
        var getdate = $('#getdate').val();
        if (getdate == '') {
            getdate = "getall";
        }

        window.open("/report/cetak/" + getdate +" " );
        
    });

</script>




<?= $this->endSection() ?>