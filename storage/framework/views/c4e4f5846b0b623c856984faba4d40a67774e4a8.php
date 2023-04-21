<!DOCTYPE html>
<html>
<head>
    <title>Academy</title>
    <meta name=viewport content="initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/plugins/simple-ine/css/simple-line-icons.css')); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/custom.css')); ?>">

</head>

<body ng-app="app">
    <?php echo $__env->yieldContent('content'); ?>
    <script type="text/javascript">
        var base_url = "<?php echo e(url('/')); ?>";
    </script>
    <?php echo $__env->yieldContent('footer_scripts'); ?>
</body>

</html><?php /**PATH /Applications/MAMP/htdocs/oigs_new/resources/views/layout_login.blade.php ENDPATH**/ ?>