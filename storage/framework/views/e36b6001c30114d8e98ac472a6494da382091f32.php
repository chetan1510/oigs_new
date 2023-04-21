

<?php $__env->startSection('content'); ?>


    <div class="login-bg">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-md-10 h-100">
                    <div class="d-flex h-100 align-items-center">
                        <div class="w-50 mob-w-100">
                            <div class="text-center mb-5 mob-mt-5">
                                <img src="<?php echo e(url('/assets/images/Group-60782.png')); ?>">
                            </div>
                            <?php if(Session::has('failure')): ?>
                                <div class="alert alert-danger">
                                  <i class="fa fa-ban-circle"></i><strong>Failure!</strong> <?php echo e(Session::get('failure')); ?>

                                </div>
                            <?php endif; ?>
                            <?php echo e(Form::open(array('url' => '/login', 'method'=>'POST',"autocomplete"=>"off","class"=>"form-horizontal"))); ?>

                                <div class="table-div mb-4">
                                    <div class="w-50">
                                        <h1 class="mb-0">Login</h1>
                                    </div>
                                    <div class="w-50">
                                        <p class="mb-0 text-right">
                                            <a href="<?php echo e(url('/sign-up')); ?>" class="text-link">Parent Sign-up</a>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="username">Username</label>

                                    <?php echo e(Form::text("username","",["class"=>"form-control login-control", "placeholder"=>"Enter username"])); ?>

                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>

                                    <?php echo e(Form::password("password",["class"=>"form-control login-control","placeholder"=>"Enter Password"])); ?>

                                </div>
                                <div class="mt-4 mb-4">
                                    <p class="mb-0">
                                        <a href="<?php echo e(url('forget-password')); ?>" class="text-link">Forgot password</a>
                                    </p>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="login-btn">Login</button>
                                    
                                </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                        <div class="w-50 mob-w-100">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/login.blade.php ENDPATH**/ ?>