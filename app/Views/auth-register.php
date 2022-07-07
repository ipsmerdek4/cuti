<?= $this->extend('Layout/auth') ?>

<?= $this->section('content') ?>
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div class="row">
            <div class="col-12 pt-5 px-4 ps-xl-5 pe-xl-4 pt-xl-4 "> 



                <div class="auth-logo text-center m-0 p-0 ">
                    <a href="<?=  route_to('login')  ?>" class="w-100 m-0 p-0 ">
                        <img src="/assets/images/logo.png" alt="Logo" class="" style="width:300px">
                        <p >Biro Perekonomian dan Administrasi<br>Pembangunan Setda Provinsi Bali</p>
                    </a>
                </div>            

                <div class="h3 mx-3 text-center"><?=lang('Auth.register')?></div>
                <p class="h6 mb-5 mx-3 text-center">Silahkan Lengkapi data dibawah ini.</p>     


                <?= view('Myth\Auth\Views\_message_block') ?>


                <form class="mx-3" action="<?= route_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4"> 
                        <div class="form-group position-relative has-icon-left mb-0">
                            <input type="email" class="form-control form-control-xl <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"  name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
                    </div>
  
                    <div class="mb-4">  
                        <div class="form-group position-relative has-icon-left mb-0">
                            <input type="text" class="form-control form-control-xl  <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>




                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password" class="form-control form-control-xl <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="pass_confirm" class="form-control form-control-xl  <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>


                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5"><?=lang('Auth.register')?></button>
                </form>

                <div class="text-center mt-5 text-sm">
                    <p class='text-gray-600'>Already have an account? <a href="<?= route_to('login') ?>" class="font-bold">Log in</a>.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">
            <img src="/assets/images/bg-4.png" class="img w-100 " alt="background"> 
        </div>
    </div>
</div>
<?= $this->endSection() ?>
