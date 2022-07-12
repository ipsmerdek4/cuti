<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= ($uri1 == 'index') ? 'active' : '' ?> ">
                    <a href="<?=base_url()?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li> 

                <?php if ($data['in_group'] = true) : ?>

                <li class="sidebar-item <?= ($uri1 == 'musers') ? 'active' : '' ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Manage Users</span>
                    </a>
                    <ul class="submenu <?= ($uri1 == 'musers') ? 'active' : '' ?>">
                        <li class="submenu-item <?= ($uri2 == 'user') ? 'active' : '' ?>">
                            <a href="<?=base_url('admin/musers/user')?>">User</a>
                        </li> 
                        <li class="submenu-item <?= ($uri2 == 'employee') ? 'active' : '' ?>">
                            <a href="<?=base_url('admin/musers/employee')?>">Employee</a>
                        </li> 
                    </ul>
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
