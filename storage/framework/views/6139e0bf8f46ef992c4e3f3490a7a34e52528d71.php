<?php $__env->startSection('title', 'Dashboard Pegawai'); ?>

<?php $__env->startSection('content'); ?>
<?php $t = fn ($s) => \App\Support\KkkLang::t($s); ?>

<div class="kkk-page-head">
    <h1><?php echo e($t('Dashboard Pegawai')); ?></h1>
    <p><?php echo e($tahun); ?></p>
</div>

<div class="kkk-grid cols-5">
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($kpi['jumlah']); ?></div><div class="l"><?php echo e($t('Jumlah permohonan')); ?></div></div>
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($kpi['dipohon']); ?></div><div class="l"><?php echo e($t('Menunggu kelulusan')); ?></div></div>
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($kpi['diLuarStor']); ?></div><div class="l"><?php echo e($t('Dokumen di luar stor')); ?></div></div>
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($kpi['dikembalikan']); ?></div><div class="l"><?php echo e($t('Menunggu pengesahan pemulangan')); ?></div></div>
    <div class="kkk-card kkk-kpi"><div class="n"><?php echo e($kpi['selesai']); ?></div><div class="l"><?php echo e($t('Selesai')); ?></div></div>
</div>

<div class="kkk-grid cols-2" style="align-items:stretch;margin-top:6px">
    <div class="kkk-card">
        <h2><?php echo e($t('Mengikut status')); ?></h2>
        <?php if($kpi['jumlah']): ?>
            <div style="position:relative;height:280px"><canvas id="kkkStatusPie"></canvas></div>
        <?php else: ?>
            <div class="kkk-empty"><?php echo e($t('Tiada rekod bagi tempoh ini.')); ?></div>
        <?php endif; ?>
    </div>

    <div class="kkk-card">
        <h2><?php echo e($t('Jenis KKK: dipohon vs selesai')); ?></h2>
        <?php if($kpi['jumlah']): ?>
            <div style="position:relative;height:280px"><canvas id="kkkKategoriBar"></canvas></div>
        <?php else: ?>
            <div class="kkk-empty"><?php echo e($t('Tiada rekod bagi tempoh ini.')); ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="kkk-grid cols-2" style="align-items:start;margin-top:16px">
    <div class="kkk-card">
        <h2><?php echo e($t('Mengikut jenis KKK')); ?></h2>
        <?php $__empty_1 = true; $__currentLoopData = $byJenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $pct = $data['jumlah'] ? round($data['selesai'] / $data['jumlah'] * 100) : 0; ?>
            <div style="margin-bottom:14px">
                <div style="display:flex;justify-content:space-between;font-size:12.5px;margin-bottom:5px">
                    <span><?php echo e($t($kategori)); ?></span>
                    <span class="kkk-muted"><?php echo e($data['selesai']); ?>/<?php echo e($data['jumlah']); ?></span>
                </div>
                <div style="background:var(--kkk-border);border-radius:6px;height:8px;overflow:hidden">
                    <div style="width:<?php echo e($pct); ?>%;background:var(--kkk-primary);height:100%"></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="kkk-empty"><?php echo e($t('Tiada rekod bagi tempoh ini.')); ?></div>
        <?php endif; ?>
    </div>

    <div class="kkk-card">
        <h2><?php echo e($t('Perlu tindakan susulan')); ?></h2>
        <?php $__empty_1 = true; $__currentLoopData = $susulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $m = $r->meta(\App\Support\KkkLang::locale()); ?>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid var(--kkk-border)">
                <div>
                    <div style="font-weight:600;font-size:13px"><?php echo e($r->no_borang); ?> · <?php echo e($r->items->first()?->sekolah?->nama); ?><?php if($r->items->count() > 1): ?> <span class="kkk-muted">+<?php echo e($r->items->count() - 1); ?></span><?php endif; ?></div>
                    <div class="kkk-muted" style="font-size:11.5px"><?php echo e(collect($r->jenis)->map($t)->implode(', ')); ?> · <?php echo e($m['label']); ?> · <?php echo e($r->tarikh_permohonan->format('d/m/Y')); ?></div>
                </div>
                <a href="<?php echo e(route('kkk.rekod', ['tahun' => $r->tarikh_permohonan->year, 'pilih' => $r->id])); ?>" class="kkk-btn kkk-btn-ghost"><?php echo e($t('Borang')); ?></a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="kkk-empty"><?php echo e($t('Tiada tindakan tertunggak.')); ?></div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    (function () {
        const dark = document.documentElement.dataset.theme === 'dark';
        const ink = dark ? '#ECEAF9' : '#1E1B3A';
        const grid = dark ? 'rgba(255,255,255,.1)' : 'rgba(30,27,58,.08)';
        Chart.defaults.font.family = "'Barlow', system-ui, sans-serif";
        Chart.defaults.color = ink;

        const status = <?php echo json_encode($byStatus, 15, 512) ?>;
        const pie = document.getElementById('kkkStatusPie');
        if (pie) {
            new Chart(pie, {
                type: 'pie',
                data: {
                    labels: status.map(s => s.label),
                    datasets: [{
                        data: status.map(s => s.jumlah),
                        backgroundColor: status.map(s => s.colour),
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

        <?php $kategoriChart = $byJenis->map(fn ($d, $k) => ['label' => $t($k)] + $d)->values(); ?>
        const kategori = <?php echo json_encode($kategoriChart, 15, 512) ?>;
        const bar = document.getElementById('kkkKategoriBar');
        if (bar) {
            new Chart(bar, {
                type: 'bar',
                data: {
                    labels: kategori.map(k => k.label),
                    datasets: [
                        { label: <?php echo json_encode($t('Jumlah permohonan'), 15, 512) ?>, data: kategori.map(k => k.jumlah), backgroundColor: dark ? '#8B86E0' : '#2E2A7A', borderRadius: 6 },
                        { label: <?php echo json_encode($t('Selesai'), 15, 512) ?>, data: kategori.map(k => k.selesai), backgroundColor: '#D4C820', borderRadius: 6 },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: grid } },
                    },
                    plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } },
                },
            });
        }
    })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.kkk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views/kkk/dashboard.blade.php ENDPATH**/ ?>