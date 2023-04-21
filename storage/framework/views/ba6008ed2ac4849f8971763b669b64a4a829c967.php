<div class="text-center">
	<div style="background:rgba(0,0,0,0.8); border-radius: 50%; height: 80px; width: 80px; display: inline-block; margin: 10px auto; overflow: hidden;display: flex;align-items: center;justify-content: center;">
		<img src="<?php echo e(url('assets/images/logo2x.png')); ?>" style="height:45px; width:auto;" />
	</div>
</div>
<?php if(!isset($sidebar)) $sidebar = ""; ?>
<ul>
	<?php echo $__env->make("menus.".$menu, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</ul><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/page_menu.blade.php ENDPATH**/ ?>