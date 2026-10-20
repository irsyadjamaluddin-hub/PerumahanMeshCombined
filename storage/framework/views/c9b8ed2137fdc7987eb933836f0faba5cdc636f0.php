







<script>
  try {
    if (window.localStorage && localStorage.getItem('mesh-theme') === 'dark') {
      document.documentElement.setAttribute('data-mesh-theme', 'dark');
    }
  } catch (e) {}
</script>
<link href="<?php echo e(asset('css/mesh-dark.css')); ?>?v=<?php echo e(filemtime(public_path('css/mesh-dark.css'))); ?>" rel="stylesheet">

<?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views/inc/theme-head.blade.php ENDPATH**/ ?>