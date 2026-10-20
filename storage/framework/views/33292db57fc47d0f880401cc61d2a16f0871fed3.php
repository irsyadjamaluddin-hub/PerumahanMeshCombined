<?php $__env->startSection('title', 'Pemeriksaan Kunci Kira-Kira'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $role = session('kkk_role');
    $locale = \App\Support\KkkLang::locale();
?>

<div class="kkk-page-head">
    <h1><?php echo e($t('Pemeriksaan Kunci Kira-Kira')); ?></h1>
    <p><?php echo e($t('Satu rekod bagi setiap sekolah, tempoh dan kategori')); ?></p>
</div>

<div class="kkk-grid cols-2" style="align-items:start">
    <div>
        <form method="GET" action="<?php echo e(route('kkk.pemeriksaan')); ?>" class="kkk-card" style="display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end">
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Tahun kewangan')); ?></label>
                <select name="tahun_kewangan" class="kkk-input" onchange="this.form.submit()">
                    <?php $__currentLoopData = $tahunPilihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Penggal')); ?></label>
                <select name="penggal" class="kkk-input" onchange="this.form.submit()">
                    <option value=""><?php echo e($t('Semua')); ?></option>
                    <option value="1" <?php echo e($penggal == '1' ? 'selected' : ''); ?>><?php echo e($t('Penggal 1 · Jan-Jun')); ?></option>
                    <option value="2" <?php echo e($penggal == '2' ? 'selected' : ''); ?>><?php echo e($t('Penggal 2 · Jul-Dis')); ?></option>
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Kategori')); ?></label>
                <select name="kategori" class="kkk-input" onchange="this.form.submit()">
                    <option value=""><?php echo e($t('Semua')); ?></option>
                    <?php $__currentLoopData = ['Kantin', 'Yuran', 'Rampaian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>" <?php echo e($kategori === $k ? 'selected' : ''); ?>><?php echo e($t($k)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </form>
    </div>

    <div>
        <?php if($selected): ?>
            <?php $m = $selected->meta($locale); $terakhirKuiri = $selected->kuiri->last(); $kuiriTerbuka = $terakhirKuiri && ! $terakhirKuiri->tarikh_jawapan; ?>
            <div class="kkk-card">
                <h2><?php echo e($selected->sekolah->nama); ?></h2>
                <p class="kkk-muted" style="margin:-8px 0 12px"><?php echo e($t($selected->kategori)); ?> · <?php echo e($t('Penggal')); ?> <?php echo e($selected->penggal); ?> · <?php echo e($selected->tahun_kewangan); ?></p>
                <span class="kkk-badge" style="background:<?php echo e($m['bg']); ?>;color:<?php echo e($m['fg']); ?>"><span class="dot" style="background:<?php echo e($m['dot']); ?>"></span><?php echo e($m['label']); ?></span>
                <?php if($selected->locked): ?>
                    <span class="kkk-badge" style="background:#ECEBF2;color:#4A4766;margin-left:6px"><?php echo e($t('Dikunci')); ?></span>
                <?php endif; ?>

                <div class="kkk-timeline" style="margin-top:16px">
                    <div class="step <?php echo e($selected->tarikh_diterima ? 'done' : ''); ?>">
                        <span class="pt"></span>
                        <span><span class="lbl"><?php echo e($t('Diterima')); ?></span> — <span class="dt"><?php echo e($selected->tarikh_diterima?->format('d/m/Y') ?? '—'); ?></span></span>
                    </div>
                    <?php $__currentLoopData = $selected->kuiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="step done">
                            <span class="pt"></span>
                            <span><span class="lbl"><?php echo e($t('Dalam kuiri')); ?> #<?php echo e($k->pusingan); ?></span> — <span class="dt"><?php echo e($k->tarikh_dihadapkan->format('d/m/Y')); ?></span></span>
                        </div>
                        <?php if($k->tarikh_jawapan): ?>
                            <div class="step done">
                                <span class="pt"></span>
                                <span><span class="lbl"><?php echo e($t('Jawapan diterima')); ?> #<?php echo e($k->pusingan); ?></span> — <span class="dt"><?php echo e($k->tarikh_jawapan->format('d/m/Y')); ?></span></span>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="step <?php echo e($selected->tarikh_tfv ? 'done' : ''); ?>">
                        <span class="pt"></span>
                        <span><span class="lbl"><?php echo e($t('True & Fair View')); ?></span> — <span class="dt"><?php echo e($selected->tarikh_tfv?->format('d/m/Y') ?? '—'); ?></span></span>
                    </div>
                </div>

                <?php if(! $selected->tarikh_diterima): ?>
                    <form method="POST" action="<?php echo e(route('kkk.pemeriksaan.terima', $selected)); ?>" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        <?php echo csrf_field(); ?>
                        <div class="kkk-field">
                            <label><?php echo e($t('Tarikh diterima')); ?></label>
                            <input type="date" name="tarikh_diterima" class="kkk-input" max="<?php echo e(now()->toDateString()); ?>" required>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('KKK diterima')); ?></button>
                    </form>
                <?php endif; ?>

                <?php if($selected->tarikh_diterima && ! $selected->locked && ! $kuiriTerbuka && $selected->kuiri->count() < 3): ?>
                    <form method="POST" action="<?php echo e(route('kkk.pemeriksaan.kuiri', $selected)); ?>" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        <?php echo csrf_field(); ?>
                        <div class="kkk-field">
                            <label><?php echo e($t('Tarikh tindakan')); ?> (<?php echo e($t('Dalam kuiri')); ?> #<?php echo e(($terakhirKuiri->pusingan ?? 0) + 1); ?>)</label>
                            <input type="date" name="tarikh_dihadapkan" class="kkk-input" max="<?php echo e(now()->toDateString()); ?>" required>
                        </div>
                        <div class="kkk-field">
                            <label><?php echo e($t('Catatan')); ?></label>
                            <textarea name="keterangan" class="kkk-input" placeholder="<?php echo e($t('Keterangan untuk makluman dan peringatan')); ?>"></textarea>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('Dalam kuiri')); ?></button>
                    </form>
                <?php endif; ?>

                <?php if($kuiriTerbuka): ?>
                    <form method="POST" action="<?php echo e(route('kkk.pemeriksaan.jawapan', $selected)); ?>" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        <?php echo csrf_field(); ?>
                        <div class="kkk-field">
                            <label><?php echo e($t('Tarikh tindakan')); ?> (<?php echo e($t('Jawapan diterima')); ?> #<?php echo e($terakhirKuiri->pusingan); ?>)</label>
                            <input type="date" name="tarikh_jawapan" class="kkk-input" max="<?php echo e(now()->toDateString()); ?>" required>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('Jawapan diterima')); ?></button>
                    </form>
                <?php endif; ?>

                <?php if($selected->tarikh_diterima && ! $selected->locked && ! $kuiriTerbuka): ?>
                    <form method="POST" action="<?php echo e(route('kkk.pemeriksaan.tfv', $selected)); ?>" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        <?php echo csrf_field(); ?>
                        <div class="kkk-field">
                            <label><?php echo e($t('Tarikh tindakan')); ?> (<?php echo e($t('True & Fair View')); ?>)</label>
                            <input type="date" name="tarikh_tfv" class="kkk-input" max="<?php echo e(now()->toDateString()); ?>" required>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-accent"><?php echo e($t('True & Fair View')); ?></button>
                    </form>
                <?php endif; ?>

                <?php if($role === 'ketua_sub' && $selected->locked): ?>
                    <form method="POST" action="<?php echo e(route('kkk.pemeriksaan.reopen', $selected)); ?>" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        <?php echo csrf_field(); ?>
                        <div class="kkk-field">
                            <label><?php echo e($t('Sebab buka semula (wajib)')); ?></label>
                            <textarea name="sebab" class="kkk-input" placeholder="<?php echo e($t('cth. pembetulan tarikh TFV')); ?>" required></textarea>
                        </div>
                        <button type="submit" class="kkk-btn kkk-btn-danger"><?php echo e($t('Buka semula rekod')); ?></button>
                    </form>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('kkk.pemeriksaan.catatan', $selected)); ?>" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                    <?php echo csrf_field(); ?>
                    <div class="kkk-field">
                        <label><?php echo e($t('Catatan')); ?></label>
                        <textarea name="catatan" class="kkk-input" placeholder="<?php echo e($t('Keterangan untuk makluman dan peringatan')); ?>"><?php echo e($selected->catatan); ?></textarea>
                    </div>
                    <button type="submit" class="kkk-btn kkk-btn-ghost"><?php echo e($t('Simpan')); ?></button>
                </form>
            </div>
        <?php else: ?>
            <form method="POST" action="<?php echo e(route('kkk.pemeriksaan.jana')); ?>" class="kkk-card">
                <?php echo csrf_field(); ?>
                <h2><?php echo e($t('Jana akaun dijangka')); ?></h2>
                <p class="kkk-muted" style="margin:-6px 0 12px;font-size:12.5px"><?php echo e($t('Cipta rekod Tidak diterima bagi setiap sekolah aktif dan setiap kategori yang belum ada.')); ?></p>
                <div class="kkk-grid cols-2">
                    <div class="kkk-field">
                        <label><?php echo e($t('Tahun kewangan')); ?></label>
                        <select name="tahun_kewangan" class="kkk-input">
                            <?php $__currentLoopData = $tahunPilihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="kkk-field">
                        <label><?php echo e($t('Penggal')); ?></label>
                        <select name="penggal" class="kkk-input" required>
                            <option value="1"><?php echo e($t('Penggal 1 · Jan-Jun')); ?></option>
                            <option value="2"><?php echo e($t('Penggal 2 · Jul-Dis')); ?></option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('Jana')); ?></button>
            </form>
        <?php endif; ?>
    </div>
</div>

<div class="kkk-card" style="padding:0;max-width:960px;margin:20px auto 0">
    <?php if($rekods->isEmpty()): ?>
        <div class="kkk-empty"><?php echo e($t('Tiada rekod bagi tempoh ini.')); ?></div>
    <?php else: ?>
        <table class="kkk-table">
            <thead>
                <tr>
                    <th><?php echo e($t('Sekolah')); ?></th>
                    <th><?php echo e($t('Kluster')); ?></th>
                    <th><?php echo e($t('Kategori')); ?></th>
                    <th><?php echo e($t('Tempoh')); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $rekods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="clickable <?php echo e($selected && $selected->id === $r->id ? 'is-selected' : ''); ?>"
                        onclick="window.location='<?php echo e(route('kkk.pemeriksaan', array_filter(['tahun_kewangan' => $tahun, 'penggal' => $penggal, 'kategori' => $kategori, 'pilih' => $r->id]))); ?>'">
                        <td><?php echo e($r->sekolah->nama); ?></td>
                        <td><?php echo e($r->sekolah->kluster); ?></td>
                        <td><?php echo e($t($r->kategori)); ?></td>
                        <td><?php echo e($t('Penggal')); ?> <?php echo e($r->penggal); ?> · <?php echo e($r->tahun_kewangan); ?></td>
                        <td>
                            <?php $m = $r->meta($locale); ?>
                            <span class="kkk-badge" style="background:<?php echo e($m['bg']); ?>;color:<?php echo e($m['fg']); ?>"><span class="dot" style="background:<?php echo e($m['dot']); ?>"></span><?php echo e($m['label']); ?></span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<form method="POST" action="<?php echo e(route('kkk.pemeriksaan.store')); ?>" class="kkk-card" style="max-width:960px;margin:20px auto 0">
    <?php echo csrf_field(); ?>
    <h2><?php echo e($t('+ Daftar KKK diterima')); ?></h2>
    <div class="kkk-grid cols-2">
        <div class="kkk-field">
            <label><?php echo e($t('Sekolah')); ?></label>
            <select name="sekolah_id" class="kkk-input" required>
                <?php $__currentLoopData = $sekolahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->id); ?>"><?php echo e($s->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="kkk-field">
            <label><?php echo e($t('Tarikh diterima')); ?> (<?php echo e($t('kosongkan jika belum diterima')); ?>)</label>
            <input type="date" name="tarikh_diterima" class="kkk-input" max="<?php echo e(now()->toDateString()); ?>">
        </div>
        <div class="kkk-field">
            <label><?php echo e($t('Tahun kewangan')); ?></label>
            <select name="tahun_kewangan" class="kkk-input">
                <?php $__currentLoopData = $tahunPilihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="kkk-field">
            <label><?php echo e($t('Penggal')); ?></label>
            <select name="penggal" class="kkk-input" required>
                <option value="1"><?php echo e($t('Penggal 1 · Jan-Jun')); ?></option>
                <option value="2"><?php echo e($t('Penggal 2 · Jul-Dis')); ?></option>
            </select>
        </div>
        <div class="kkk-field">
            <label><?php echo e($t('Kategori')); ?></label>
            <select name="kategori" class="kkk-input" required>
                <option value="Kantin"><?php echo e($t('Kantin')); ?></option>
                <option value="Yuran"><?php echo e($t('Yuran')); ?></option>
                <option value="Rampaian"><?php echo e($t('Rampaian')); ?></option>
            </select>
        </div>
    </div>
    <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('Simpan')); ?></button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.kkk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views/kkk/pemeriksaan.blade.php ENDPATH**/ ?>