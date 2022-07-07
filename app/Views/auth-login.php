<?= $this->extend('Layout/auth') ?>

<?= $this->section('content') ?>
<div class="row h-100">
    <div class="col-lg-5 col-12"> 
            <div class="row">
                <div class="col-12 pt-5 px-4 ps-xl-5 pe-xl-4 pt-xl-4"> 
                   
                    
                    <div class="auth-logo text-center m-0 p-0 ">
                        <a href="<?=  route_to('login')  ?>" class="w-100 m-0 p-0 ">
                            <img src="/assets/images/logo.png" alt="Logo" class="" style="width:300px">
                            <p >Biro Perekonomian dan Administrasi<br>Pembangunan Setda Provinsi Bali</p>
                        </a>
                    </div>            
                    <div class="h5 mx-3 text-center"><?=lang('Auth.loginTitle')?></div>
                    <p class="h6 mb-5 mx-3  text-center">Silahkan Masuk untuk memulai Sistem.</p>

                    
					<?= view('Myth\Auth\Views\_message_block') ?>


                    <form action="<?= route_to('login') ?>" method="post" class="mx-3">
						<?= csrf_field() ?> 

                        <?php if ($config->validFields === ['email']): ?> 
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="email" class="form-control form-control-xl <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.email')?>">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div> 
                        <?php else: ?>
                            
                            <div class="mb-4">
                                <div class="form-group position-relative has-icon-left mb-0"> 
                                        <input type="text" class="form-control form-control-xl <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.emailOrUsername')?>" >
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>  
                                </div>
                                <small class="text-danger"><?= session('errors.login') ?></small>
                            </div>
                        <?php endif; ?>
  

                        <div class="mb-4"> 
                            <div class="form-group position-relative has-icon-left mb-0">
                                <input type="password" class="form-control form-control-xl <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?=lang('Auth.password')?>">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div> 
                            </div>
                            <small class="text-danger"> <?= session('errors.password') ?></small>

                        </div>
  


                        <?php if ($config->allowRemembering): ?> 
                            <div class="form-check form-check-lg d-flex align-items-end">
                                <input class="form-check-input me-2" type="checkbox" name="remember" <?php if(old('remember')) : ?> checked <?php endif ?>>
                                <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                    <?=lang('Auth.rememberMe')?>
                                </label>
                            </div> 
                        <?php endif; ?>     
 
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5"><?=lang('Auth.loginAction')?></button>



                    </form>
                    <div class="text-center mt-5 text-sm">
                    <?php if ($config->allowRegistration) : ?>
                        <p class="text-gray-600 ">Don't have an account? <a href="<?= route_to('register') ?>" class="font-bold">Sign Up</a>.</p>
                    <?php endif; ?>
                    <?php if ($config->activeResetter): ?> 
                            <p><a class="font-bold" href="<?= route_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a>.</p>

                    <?php endif; ?>
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
