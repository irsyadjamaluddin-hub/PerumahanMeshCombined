<?php $__env->startSection('title', 'MOE MESH - Home'); ?>











<?php $__env->startSection('content'); ?>

  <?php
    // pagename drives the header title and the sidebar active-state check in app-all.blade.php
    $pagename = "";
  ?>

    <?php if(session('success')): ?>
    <div class="alert alert-success" style="margin-top: 20px">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    
    
    
    <?php echo $__env->make('inc.home-greeting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('inc.home-services', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-all', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views//home.blade.php ENDPATH**/ ?>