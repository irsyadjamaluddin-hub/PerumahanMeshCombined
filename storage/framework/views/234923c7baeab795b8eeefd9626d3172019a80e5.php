<?php $__env->startSection('title', 'Dashboard Eksekutif'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $locale = \App\Support\KkkLang::locale();
?>

<div class="kkk-page-head">
    <h1><?php echo e($t('Dashboard Eksekutif')); ?></h1>
    <p><?php echo e($tahun); ?></p>
</div>

<div class="kkk-grid cols-3">
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($tiles['jumlahSekolah']); ?></div><div class="l"><?php echo e($t('Jumlah sekolah')); ?></div></div>
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($tiles['sekolahDipinjam']); ?></div><div class="l"><?php echo e($t('Sekolah dengan dokumen dipinjam')); ?></div></div>
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($tiles['permohonan']); ?></div><div class="l"><?php echo e($t('Permohonan peminjaman tahun ini')); ?></div></div>
</div>

<div class="kkk-grid cols-2" style="align-items:stretch;margin-top:6px">
    <div class="kkk-card">
        <h2><?php echo e($t('Dokumen sekolah')); ?></h2>
        <?php if($tiles['jumlahSekolah']): ?>
            <div style="position:relative;height:280px"><canvas id="kkkSekolahPie"></canvas></div>
        <?php else: ?>
            <div class="kkk-empty"><?php echo e($t('Tiada rekod bagi tempoh ini.')); ?></div>
        <?php endif; ?>
    </div>

    <div class="kkk-card">
        <h2><?php echo e($t('Permohonan mengikut bulan')); ?></h2>
        <?php if($tiles['permohonan']): ?>
            <div style="position:relative;height:280px"><canvas id="kkkKategoriBar"></canvas></div>
        <?php else: ?>
            <div class="kkk-empty"><?php echo e($t('Tiada rekod bagi tempoh ini.')); ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="kkk-card" style="margin-top:16px;padding:0">
    <table class="kkk-table">
        <thead>
            <tr>
                <th><?php echo e($t('Sekolah')); ?></th>
                <th><?php echo e($t('Peringkat')); ?></th>
                <th><?php echo e($t('Kluster')); ?></th>
                <th><?php echo e($t('Pemimpin semasa')); ?></th>
                <th><?php echo e($t('Kantin')); ?></th>
                <th><?php echo e($t('Yuran')); ?></th>
                <th><?php echo e($t('Rampaian')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sekolahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($s->nama); ?></td>
                    <td><?php echo e($t($s->peringkat)); ?></td>
                    <td><?php echo e($s->kluster); ?></td>
                    <td><?php echo e($s->pemimpinSemasa->nama ?? '—'); ?></td>
                    <?php $__currentLoopData = ['Kantin', 'Yuran', 'Rampaian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $b = $diLuar[$s->id][$kat] ?? null; ?>
                        <td>
                            <?php if($b): ?>
                                <?php $m = $b->meta($locale); ?>
                                <span class="kkk-badge" style="background:<?php echo e($m['bg']); ?>;color:<?php echo e($m['fg']); ?>" title="<?php echo e($b->no_borang); ?>"><span class="dot" style="background:<?php echo e($m['dot']); ?>"></span><?php echo e($m['label']); ?></span>
                            <?php else: ?>
                                <span class="kkk-muted"><?php echo e($t('Dalam stor')); ?></span>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php
    $bulanLabels = array_map($t, ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogo', 'Sep', 'Okt', 'Nov', 'Dis']);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    (function () {
        const dark = document.documentElement.dataset.theme === 'dark';
        const grid = dark ? 'rgba(255,255,255,.1)' : 'rgba(30,27,58,.08)';
        Chart.defaults.font.family = "'Barlow', system-ui, sans-serif";
        Chart.defaults.color = dark ? '#ECEAF9' : '#1E1B3A';

        const sekolah = <?php echo json_encode($sekolahChart, 15, 512) ?>;
        const pie = document.getElementById('kkkSekolahPie');
        if (pie) {
            new Chart(pie, {
                type: 'pie',
                data: {
                    labels: sekolah.map(s => s.label),
                    datasets: [{
                        data: sekolah.map(s => s.jumlah),
                        backgroundColor: sekolah.map(s => s.colour),
                        borderColor: dark ? '#1E1B3A' : '#fff',
                        borderWidth: 2,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'right', labels: { usePointStyle: true, padding: 14 } } },
                },
            });
        }

        const bar = document.getElementById('kkkKategoriBar');
        if (bar) {
            new Chart(bar, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($bulanLabels, 15, 512) ?>,
                    datasets: [{ label: <?php echo json_encode($t('Permohonan'), 15, 512) ?>, data: <?php echo json_encode($bulanan, 15, 512) ?>, backgroundColor: dark ? '#8B86E0' : '#2E2A7A', borderRadius: 6 }],
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: grid } },
                    },
                    plugins: { legend: { display: false } },
                },
            });
        }
    })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.kkk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views/kkk/exec.blade.php ENDPATH**/ ?>