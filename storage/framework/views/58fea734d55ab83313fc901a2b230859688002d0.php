<!DOCTYPE html>
<html>
<head>
    <title>Academy</title>
    <meta charset="utf-8">
    <meta name=viewport content="initial-scale=1">

    <?php if(env('APP_ENV') == "production" || env('APP_ENV') == "online"): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/dist/css/fonts.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/dist/css/combined.min.css')); ?>" />
        <script src="<?php echo e(url('assets/dist/js/jquery.min.js')); ?>" type="text/javascript"></script>
    <?php else: ?>

        <link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/fonts.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/plugins/simple-ine/css/simple-line-icons.css')); ?>" />
    	<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/custom.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(url('assets/plugins/admin/scripts/ui-cropper.css')); ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('assets/plugins/admin/scripts/jquery-cropper/croppie.css')); ?>" type="text/css">
        <script src="<?php echo e(url('assets/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
    <?php endif; ?>

</head>
<body ng-app="app">
    <div class="wrapper">
        <div class="page-menu">
            <?php echo $__env->make('page_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="main">
            <?php echo $__env->make('page_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('sub_header'); ?>
            <div class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        var base_url = "<?php echo e(url('/')); ?>";

        <?php if(Auth::check()): ?>
            var api_key = "<?php echo e(Auth::user()->api_key); ?>";
            var client_id = "<?php echo e(Auth::user()->client_id); ?>";
            var currency_format = "INR";
        <?php else: ?>
            var api_key = "";
            var client_id = "";
            var currency_format = "INR";
        <?php endif; ?>
        
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    
    <?php if(env('APP_ENV') == "production" || env('APP_ENV') == "online"): ?>
        <script type="text/javascript" src="<?php echo e(url('assets/dist/js/bundle.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(url('assets/dist/js/combined.min.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(url('assets/plugins/popper.js')); ?>"></script>
        <script src="<?php echo e(url('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(url('assets/plugins/bootbox.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/echarts.min.js')); ?>"></script>

        <!--Begin Angular scripts -->
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/angular.min.js')); ?>" ></script>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/angular-sanitize.js')); ?>" ></script>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/ng-file-upload.min.js')); ?>" ></script>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/ng-file-upload-shim.min.js')); ?>" ></script>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/jcs-auto-validate.js')); ?>" ></script>
        <script src="<?php echo e(url('assets/plugins/admin/scripts/jquery-cropper/croppie.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(url('assets/plugins/admin/scripts/ui-cropper.js')); ?>" type="text/javascript"></script>

        <?php $version = "1.0.2"; ?>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/core/custom.js?v='.$version)); ?>"></script>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/core/app.js?v='.$version)); ?>" ></script>
        <script type="text/javascript" src="<?php echo e(url('assets/plugins/admin/scripts/core/services.js?v='.$version)); ?>" ></script>
        <?php echo $__env->make('admin_angular', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endif; ?>

    <?php echo $__env->yieldContent('footer_scripts'); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/layout.blade.php ENDPATH**/ ?>