<?php
$uri = service('uri')->getSegments();
/*  
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
 */
(isset($uri[0]))? $uri0 = $uri[0] : $uri0 = "";
(isset($uri[1]))? $uri1 = $uri[1] : $uri1 = "";
  
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center ">
                <div class="logo text-center">
                    <a href="<?=base_url()?>" >
                        <img src="<?=base_url()?>/assets/images/logo.png" alt="Logo" style="width:150px; height: 100px;">
                    </a> 
                    <h5 style="font-size: 10px;">Biro Perekonomian dan Administrasi<br>Pembangunan Setda Provinsi Bali</h5>
                </div> 
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu mt-0">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= ($uri0 == '') ? 'active' : '' ?> ">
                    <a href="<?=base_url()?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li> 

                <?php if (in_groups('administrator') == true) : ?>

                    <li class="sidebar-item <?= ($uri0 == 'musers') ? 'active' : '' ?> has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Manage Users</span>
                        </a>
                        <ul class="submenu <?= ($uri0 == 'musers') ? 'active' : '' ?>">
                            <li class="submenu-item <?= ($uri1 == 'user') ? 'active' : '' ?>">
                                <a href="<?=base_url('musers/user')?>">User</a>
                            </li> 
                            <li class="submenu-item <?= ($uri1 == 'pegawai') ? 'active' : '' ?>">
                                <a href="<?=base_url('musers/pegawai')?>">Pegawai</a>
                            </li> 
                        </ul>
                    </li> 
                
                <?php endif; ?>  

                <li class="sidebar-item <?= ($uri0 == 'mcuti') ? 'active' : '' ?> ">
                    <a href="<?=base_url()?>/mcuti" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Manage Cuti</span>
                    </a>
                </li> 

                <?php if ((in_groups('administrator') == true)||(in_groups('kplbgn'))) : ?>

                <li class="sidebar-item <?= ($uri0 == 'report') ? 'active' : '' ?> ">
                    <a href="<?=base_url()?>/report" class='sidebar-link'>
                        <i class="bi bi-file-earmark-bar-graph"></i>    
                        <span>Laporan Cuti</span>
                    </a>
                </li> 
                <?php endif; ?>  



                <li class="sidebar-title text-primary">
                    <hr>
                </li>



                <li class="sidebar-item ">
                    <a href="<?= base_url('logout') ?>" class='sidebar-link text-danger'>  
                        <span class="fa-fw select-all fas text-danger"></span>  
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>


<?= $this->section('styles') ?>
<link rel="stylesheet" href="a/ssets/vendors/fontawesome/all.min.css">
<style>
    .fontawesome-icons {
        text-align: center;
    }

    article dl {
        background-color: rgba(0, 0, 0, .02);
        padding: 20px;
    }

    .fontawesome-icons .the-icon svg {
        font-size: 24px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/assets/vendors/fontawesome/all.min.js"></script>
<?= $this->endSection() ?>
