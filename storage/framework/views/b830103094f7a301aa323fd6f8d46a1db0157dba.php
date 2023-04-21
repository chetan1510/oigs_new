
<?php $__env->startSection('content'); ?>
<?php for($i=1;$i<20;$i++): ?>
  <?php $__currentLoopData = $gems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div id="example2" class="sss">
      <img src="<?php echo e(url('/'.$item->certi_front)); ?>" class="front-image">
       <table class="table-design font" >
          <tbody class="tbody-design">
            <center>
              <?php echo e(QrCode::size(100)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8')); ?>

            </center>
            <tr>
              <td width="32%"><span class="s">&nbsp;&nbsp;&nbsp;Certificate No</span></td>
              <td width="43%"><span class="marg"><?php echo e($item->report_no); ?></span></td>               
              <td style="width:5%" rowspan="2" style="white-space: nowrap;"><span class="description"><?php echo e($item->description); ?></span></td>
            </tr> 

            <?php if($item->weight): ?>
              <tr> 
                <td style=""><span class="s">&nbsp;&nbsp;&nbsp;Weight</span></td>
                <td style=""><span class="marg"><?php echo e($item->weight); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($item->weight_type); ?></span></td>
                <td style="" colspan="1"><span>&nbsp;</span></td>
              </tr>
            <?php endif; ?>

            <?php if($item->shape_cut): ?>
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Shape Cut</span></td>
                <td><span class="marg"><?php echo e($item->shape_cut); ?></span></td>
                <td style="" colspan="1"><span>&nbsp;</span></td>
              </tr>
            <?php endif; ?>

            <?php if($item->measurement): ?>
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Measurement</span></td>
                <td><span class="marg"><?php echo e($item->measurement); ?>&nbsp;&nbsp;&nbsp;<?php echo e($item->mesurement_type); ?></span></td>
                <td style="" colspan="1"><span>&nbsp;</span></td>
              </tr> 
            <?php endif; ?>

            <?php if($item->color): ?>
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Colour</span></td>
                <td colspan="3"><span class="marg"><?php echo e($item->color); ?></span></td>
              </tr> 
            <?php endif; ?>      

            <?php if($item->optic_character): ?>
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Optic Character</span></td>
                <td><span class="marg"><?php echo e($item->optic_character); ?></span></td>
                <center><img class="product-image" src="<?php echo e(url('/'.$item->prod_image)); ?>"/></center>
              </tr>
            <?php endif; ?>

            <?php if($item->ri): ?>
              <tr>
                <td style=""><span class="s">&nbsp;&nbsp;&nbsp;Refractive Index</span></td>
                <td style="" colspan="2"><span class="marg"><?php echo e($item->ri); ?></span></td>              
              </tr>
            <?php endif; ?>

            <?php if($item->sg): ?>
              <tr>
                <td style=""><span class="s">&nbsp;&nbsp;&nbsp;Specific Garvity</span></td>
                <td style=""><span class="marg"><?php echo e($item->sg); ?></span></td>
              </tr>
            <?php endif; ?>

            <?php if($item->microscopic_obs): ?>
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Microscopic&nbsp;Obs:</span></td>
                <td><span class="marg"><?php echo e($item->microscopic_obs); ?></span></td>
              </tr>
            <?php endif; ?>

            <?php if($item->species): ?>
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Species</span></td>
                <td><span class="marg"><?php echo e($item->species); ?></span></td>
              </tr>
            <?php endif; ?>

            <?php if($item->comments): ?>
              <tr> 
                <td><span class="s">&nbsp;&nbsp;&nbsp;Comments</span></td>
                <td><span class="marg"><?php echo e($item->comments); ?></span></td>
              </tr>
            <?php endif; ?>

            <?php if($item->result): ?>
            <tr>
              <td colspan="2" class="box"><h3 class="result"><?php echo e($item->result); ?></h3></td>
            </tr>
            <?php endif; ?>
          </tbody>
       </table>
    </div>
    
    <div id="exam2" class="back-img-div-top">
       <div class="back-img-div" >
          <img src="<?php echo e(url('/'.$item->certi_back)); ?>" class="back-img">
       </div>
    </div>  
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endfor; ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('small_report_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/gems/small.blade.php ENDPATH**/ ?>