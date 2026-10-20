<?php $__env->startSection('title', 'Peminjaman Kunci Kira-Kira'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $t = fn ($s) => \App\Support\KkkLang::t($s);
    $role = session('kkk_role');
    $locale = \App\Support\KkkLang::locale();
    $Borang = \App\Models\Kkk\KkkPeminjaman::class;
    $roleNama = \App\Http\Controllers\KkkController::ROLES;

    // Heading for each signature block on the borang.
    $stepLabel = [
        'benarkan' => 'Dibenarkan oleh',
        'tolak' => 'Ditolak oleh',
        'keluarkan' => 'Dikeluarkan oleh',
        'terima' => 'Dokumen diterima dengan sempurna oleh pemohon',
        'kembalikan' => 'Dikembalikan oleh',
        'terima-stor' => 'Pemulangan diterima oleh',
    ];
?>


<?php
    // Circles: white fill + purple outline; a finished stage turns green fill + purple outline.
    // --c fill, --b border/line/ring, --fg number colour
    $warnaBelum   = '--c:#ffffff;--b:#2E2A7A;--fg:#2E2A7A';
    $warnaSelesai = '--c:#1E8A4F;--b:#2E2A7A;--fg:#ffffff';

    $alur = [['key' => null, 'label' => $t('Diterima'), 'sub' => $t('Borang sekolah'), 'n' => $alurDiterima, 'href' => '#penerimaan']];
    foreach ($Borang::META as $key => $m) {
        if ($key === 'ditolak') continue;
        $alur[] = ['key' => $key, 'label' => $m['label'][$locale === 'en' ? 1 : 0], 'sub' => null, 'n' => $alurKiraan[$key] ?? 0,
                   'href' => route('kkk.rekod', array_filter(['tahun' => $tahun, 'status' => $status === $key ? null : $key, 'jenis' => $jenis]))];
    }

    // The timeline follows ONE record: every stage up to its current status is green, the rest white.
    //  - a borang is selected            -> that borang
    //  - a new school submission arrived -> all white (reset) until a borang is made from it
    //  - otherwise                        -> the newest borang (all green once it is Selesai)
    $ikut = $selected ?: ($alurBaharu ? null : $alurBorang);
    $kedudukan = $ikut && $ikut->status !== 'ditolak'
        ? collect($alur)->search(fn ($s) => $s['key'] === $ikut->status)
        : false;
    foreach ($alur as $i => &$s) {
        $s['siap'] = $kedudukan !== false && $i <= $kedudukan;
        $s['warna'] = $s['siap'] ? $warnaSelesai : $warnaBelum;
    }
    unset($s);

    // Caption: which record is being followed
    if ($ikut) {
        $ikutLabel = $ikut->no_borang.' · '.($ikut->items->first()?->sekolah?->nama ?? '');
        $ikutStatus = $ikut->meta($locale)['label'];
    } elseif ($alurBaharu) {
        $ikutLabel = $alurPenerimaan->nama_sekolah;
        $ikutStatus = $t('Rekod baharu');
    } else {
        $ikutLabel = null;
    }
    $ditolak = $Borang::META['ditolak'];
?>
<nav class="kkk-alur" aria-label="<?php echo e($t('Aliran Peminjaman')); ?>">
    <div class="kkk-alur-head">
        <span>
            <?php echo e($t('Aliran Peminjaman')); ?> · <?php echo e($tahun); ?>

            <?php if($ikutLabel): ?>
                <span class="kkk-alur-ikut"><?php echo e($t('Mengikut')); ?>: <b><?php echo e($ikutLabel); ?></b> — <?php echo e($ikutStatus); ?></span>
            <?php endif; ?>
        </span>
        <a href="<?php echo e(route('kkk.rekod', array_filter(['tahun' => $tahun, 'status' => $status === 'ditolak' ? null : 'ditolak', 'jenis' => $jenis]))); ?>"
           class="kkk-alur-tolak <?php echo e($status === 'ditolak' ? 'is-on' : ''); ?>" style="--c: <?php echo e($ditolak['dot']); ?>">
            &times; <?php echo e($ditolak['label'][$locale === 'en' ? 1 : 0]); ?> <b><?php echo e($alurKiraan['ditolak'] ?? 0); ?></b>
        </a>
    </div>
    <ol class="kkk-alur-steps">
        <?php $__currentLoopData = $alur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php echo e($s['n'] > 0 ? 'has' : ''); ?> <?php echo e($s['siap'] ? 'siap' : ''); ?> <?php echo e($s['key'] && $status === $s['key'] ? 'is-on' : ''); ?>" style="<?php echo e($s['warna']); ?>">
                <a href="<?php echo e($s['href']); ?>" title="<?php echo e($s['label']); ?>: <?php echo e($s['n']); ?>">
                    <span class="kkk-alur-dot"><?php echo e($s['n']); ?></span>
                    <span class="kkk-alur-lbl"><?php echo e($i + 1); ?>. <?php echo e($s['label']); ?></span>
                    <?php if($s['sub']): ?><span class="kkk-alur-sub"><?php echo e($s['sub']); ?></span><?php endif; ?>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav>

<div class="kkk-page-head">
    <h1><?php echo e($t('Peminjaman Kunci Kira-Kira')); ?></h1>
    <p><?php echo e($t('Borang Permohonan Peminjaman Dokumen Kunci Kira-Kira Kewangan Sekolah (FRRV)')); ?></p>
</div>

<div class="kkk-grid cols-2" style="align-items:start">
    <div>
        <form method="GET" action="<?php echo e(route('kkk.rekod')); ?>" class="kkk-card" style="display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end">
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Tahun')); ?></label>
                <select name="tahun" class="kkk-input" onchange="this.form.submit()">
                    <?php $__currentLoopData = $tahunPilihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Status')); ?></label>
                <select name="status" class="kkk-input" onchange="this.form.submit()">
                    <option value=""><?php echo e($t('Semua')); ?></option>
                    <?php $__currentLoopData = $Borang::META; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e($status === $key ? 'selected' : ''); ?>><?php echo e($m['label'][$locale === 'en' ? 1 : 0]); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Jenis KKK')); ?></label>
                <select name="jenis" class="kkk-input" onchange="this.form.submit()">
                    <option value=""><?php echo e($t('Semua')); ?></option>
                    <?php $__currentLoopData = $Borang::JENIS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($j); ?>" <?php echo e($jenis === $j ? 'selected' : ''); ?>><?php echo e($t($j)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </form>
    </div>

    <div>
        <?php if($selected): ?>
            <?php $m = $selected->meta($locale); ?>
            <div class="kkk-card">
                <a href="<?php echo e(route('kkk.borang', ['pilih' => $selected->id])); ?>" target="_blank" class="kkk-btn kkk-btn-ghost" style="float:right"><?php echo e($t('Cetak Borang')); ?></a>
                <h2><?php echo e($selected->no_borang); ?></h2>
                <p class="kkk-muted" style="margin:-8px 0 12px">
                    <?php echo e(collect($selected->jenis)->map($t)->implode(', ')); ?> · <?php echo e($t($selected->tujuanLabel())); ?> · <?php echo e($selected->tarikh_permohonan->format('d/m/Y')); ?>

                </p>
                <span class="kkk-badge" style="background:<?php echo e($m['bg']); ?>;color:<?php echo e($m['fg']); ?>"><span class="dot" style="background:<?php echo e($m['dot']); ?>"></span><?php echo e($m['label']); ?></span>

                <table class="kkk-table" style="margin-top:14px">
                    <thead><tr><th><?php echo e($t('Bil')); ?></th><th><?php echo e($t('Nama Sekolah')); ?></th><th><?php echo e($t('Tempoh dan Tahun KKK')); ?></th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $selected->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr><td><?php echo e($item->bil); ?></td><td><?php echo e($item->sekolah?->nama); ?></td><td><?php echo e($t($item->tempoh())); ?></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div class="kkk-timeline" style="margin-top:16px">
                    <?php
                        $timeline = [
                            ['Dipohon oleh', $selected->pemohon_nama, $selected->tarikh_permohonan],
                            [$selected->status === 'ditolak' ? 'Ditolak oleh' : 'Dibenarkan oleh', $selected->dibenarkan_nama, $selected->tarikh_dibenarkan],
                            ['Dikeluarkan oleh', $selected->dikeluarkan_nama, $selected->tarikh_dikeluarkan],
                            ['Diterima oleh pemohon', $selected->diterima_nama, $selected->tarikh_diterima],
                            ['Dikembalikan oleh', $selected->dikembalikan_nama, $selected->tarikh_dikembalikan],
                            ['Pemulangan diterima oleh', $selected->diterima_stor_nama, $selected->tarikh_diterima_stor],
                        ];
                        if ($selected->status === 'ditolak') {
                            $timeline = array_slice($timeline, 0, 2);
                        }
                    ?>
                    <?php $__currentLoopData = $timeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $nama, $tarikh]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="step <?php echo e($tarikh ? 'done' : ''); ?>">
                            <span class="pt"></span>
                            <span><span class="lbl"><?php echo e($t($label)); ?></span> — <span class="dt"><?php echo e($tarikh ? $nama.' · '.$tarikh->format('d/m/Y') : '—'); ?></span></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if($selected->sebab_ditolak): ?>
                    <p style="font-size:12.5px"><strong><?php echo e($t('Sebab ditolak')); ?>:</strong> <?php echo e($selected->sebab_ditolak); ?></p>
                <?php endif; ?>
                <?php if($selected->catatan_semakan): ?>
                    <p style="font-size:12.5px"><strong><?php echo e($t('Semakan atau catatan')); ?>:</strong> <?php echo e($selected->catatan_semakan); ?></p>
                <?php endif; ?>

                <?php
                    $bolehLangkah = collect($steps)->filter(fn ($s) => $s['from'] === $selected->status);
                    $langkahSaya = $bolehLangkah->filter(fn ($s) => $s['role'] === $role);
                    $langkah = $langkahSaya->keys()->first();
                ?>

                <?php if($langkah): ?>
                    <?php
                        $s = $steps[$langkah];
                        $p = $s['prefix'];
                        $namaLalai = $role === 'pemohon' ? $selected->pemohon_nama : '';
                        $jawatanLalai = $role === 'pemohon' ? $selected->pemohon_jawatan : $roleNama[$role];
                    ?>
                    <form method="POST" action="<?php echo e(route('kkk.rekod.langkah', [$selected, $langkah])); ?>" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px">
                        <?php echo csrf_field(); ?>
                        <h2><?php echo e($t($stepLabel[$langkah])); ?></h2>
                        <div class="kkk-grid cols-2">
                            <div class="kkk-field">
                                <label><?php echo e($t('Nama')); ?></label>
                                <input type="text" name="<?php echo e($p); ?>_nama" class="kkk-input" value="<?php echo e(old($p.'_nama', $namaLalai)); ?>" required>
                            </div>
                            <div class="kkk-field">
                                <label><?php echo e($t('Jawatan')); ?></label>
                                <input type="text" name="<?php echo e($p); ?>_jawatan" class="kkk-input" value="<?php echo e(old($p.'_jawatan', $jawatanLalai)); ?>">
                            </div>
                        </div>
                        <div class="kkk-field">
                            <label><?php echo e($t('Tarikh')); ?></label>
                            <input type="date" name="<?php echo e($s['tarikh']); ?>" class="kkk-input" value="<?php echo e(old($s['tarikh'], now()->toDateString())); ?>"
                                   min="<?php echo e($selected->{$s['selepas']}?->toDateString()); ?>" max="<?php echo e(now()->toDateString()); ?>" required>
                        </div>

                        <?php if($langkah === 'benarkan'): ?>
                            <div class="kkk-field">
                                <label><?php echo e($t('Sebab ditolak (jika ditolak)')); ?></label>
                                <textarea name="sebab_ditolak" class="kkk-input"><?php echo e(old('sebab_ditolak')); ?></textarea>
                            </div>
                            <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('Benarkan')); ?></button>
                            <button type="submit" class="kkk-btn kkk-btn-danger" formaction="<?php echo e(route('kkk.rekod.langkah', [$selected, 'tolak'])); ?>"><?php echo e($t('Tolak')); ?></button>
                        <?php elseif($langkah === 'terima-stor'): ?>
                            <div class="kkk-field">
                                <label><?php echo e($t('Semakan atau catatan')); ?></label>
                                <textarea name="catatan_semakan" class="kkk-input"><?php echo e(old('catatan_semakan')); ?></textarea>
                            </div>
                            <button type="submit" class="kkk-btn kkk-btn-accent"><?php echo e($t('Sahkan pemulangan')); ?></button>
                        <?php else: ?>
                            <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('Sahkan')); ?></button>
                        <?php endif; ?>
                    </form>
                <?php elseif($bolehLangkah->isNotEmpty()): ?>
                    <p class="kkk-muted" style="margin-top:14px;border-top:1px solid var(--kkk-border);padding-top:14px;font-size:12.5px">
                        <?php echo e($t('Menunggu tindakan')); ?>: <?php echo e($t($roleNama[$bolehLangkah->first()['role']])); ?>

                    </p>
                <?php endif; ?>
            </div>
        
        <?php endif; ?>
    </div>
</div>


<?php
    $kategoriWarna = fn ($k) => $k === 'Baru'
        ? ['bg' => '#e6f4ea', 'fg' => '#1e6b3a', 'dot' => '#2e9b57']
        : ['bg' => '#fff4e0', 'fg' => '#8a5300', 'dot' => '#e08a00'];
?>
<div class="kkk-card" id="penerimaan" style="max-width:960px;margin:20px auto 0">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap">
        <div>
            <h2 style="margin-bottom:4px"><?php echo e($t('Penerimaan Kunci Kira-Kira')); ?></h2>
            <p class="kkk-muted" style="margin:0;font-size:12.5px">
                <?php echo e($t('Rekod daripada borang sekolah')); ?> ·
                <a href="<?php echo e(route('kkk.pengesahan')); ?>" target="_blank"><?php echo e($t('Buka borang')); ?></a> ·
                <?php echo e($penerimaan->total()); ?> <?php echo e($t('rekod')); ?>

            </p>
        </div>
        <form method="GET" action="<?php echo e(route('kkk.rekod')); ?>#penerimaan" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
            
            <?php $__currentLoopData = array_filter(['tahun' => $tahun, 'status' => $status, 'jenis' => $jenis, 'pilih' => request('pilih')]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="<?php echo e($k); ?>" value="<?php echo e($v); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Kluster')); ?></label>
                <select name="p_kluster" class="kkk-input" onchange="this.form.submit()">
                    <option value=""><?php echo e($t('Semua')); ?></option>
                    <?php $__currentLoopData = $klusterPilihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>" <?php echo e($pKluster === $k ? 'selected' : ''); ?>><?php echo e($k); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="kkk-field" style="margin:0">
                <label><?php echo e($t('Cari')); ?></label>
                <input type="search" name="p_cari" class="kkk-input" value="<?php echo e($pCari); ?>" placeholder="<?php echo e($t('Sekolah atau penghantar')); ?>">
            </div>
            <button type="submit" class="kkk-btn kkk-btn-ghost"><?php echo e($t('Cari')); ?></button>
        </form>
    </div>

    
    <?php if($errors->any()): ?>
        <div class="kkk-alert err" style="margin-top:12px">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>&times; <?php echo e($e); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if($penerimaan->isEmpty()): ?>
        <div class="kkk-empty"><?php echo e($t('Tiada rekod penerimaan.')); ?></div>
    <?php else: ?>
        <div style="overflow-x:auto;margin-top:14px">
            <table class="kkk-table">
                <thead>
                    <tr>
                        <th><?php echo e($t('Tarikh Diterima')); ?></th>
                        <th><?php echo e($t('Sekolah')); ?></th>
                        <th><?php echo e($t('Kategori')); ?></th>
                        <th><?php echo e($t('Jenis KKK')); ?></th>
                        <th><?php echo e($t('Tempoh dan Tahun KKK')); ?></th>
                        <th><?php echo e($t('Penghantar')); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $penerimaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $w = $kategoriWarna($r->kategori); ?>
                        <tr>
                            <td style="white-space:nowrap"><?php echo e($r->created_at->format('d/m/Y')); ?><br><span class="kkk-muted"><?php echo e($r->created_at->format('h:i A')); ?></span></td>
                            <td><?php echo e($r->nama_sekolah); ?><br><span class="kkk-muted"><?php echo e($r->kluster); ?></span></td>
                            <td><span class="kkk-badge" style="background:<?php echo e($w['bg']); ?>;color:<?php echo e($w['fg']); ?>"><span class="dot" style="background:<?php echo e($w['dot']); ?>"></span><?php echo e($t($r->kategori)); ?></span></td>
                            <td><?php echo e($t($r->jenis)); ?></td>
                            <td style="white-space:nowrap"><?php echo e($t($r->tempoh)); ?><br><span class="kkk-muted"><?php echo e($r->tahun); ?></span></td>
                            <td><?php echo e($r->nama_penghantar); ?><br><span class="kkk-muted"><?php echo e($r->jawatan); ?> · <?php echo e($r->no_tel); ?></span></td>
                            <td style="text-align:right;white-space:nowrap">
                                
                                <?php if($role !== 'pemohon'): ?>
                                    <span class="kkk-btn kkk-btn-primary" style="opacity:.45;cursor:not-allowed" title="<?php echo e($t('Tukar peranan kepada Pemohon untuk menghantar permohonan')); ?>"><?php echo e($t('Hantar permohonan')); ?></span>
                                <?php elseif(! $r->sekolah_id): ?>
                                    <span class="kkk-btn kkk-btn-primary" style="opacity:.45;cursor:not-allowed" title="<?php echo e($t('Sekolah tiada dalam senarai sekolah KKK')); ?>"><?php echo e($t('Hantar permohonan')); ?></span>
                                <?php else: ?>
                                    <form method="POST" action="<?php echo e(route('kkk.rekod.store')); ?>" style="margin:0" onsubmit="return kkkPemohon(this)">
                                        <?php echo csrf_field(); ?>
                                        <?php $__currentLoopData = $r->jenis_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="hidden" name="jenis[]" value="<?php echo e($j); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <input type="hidden" name="items[0][sekolah_id]" value="<?php echo e($r->sekolah_id); ?>">
                                        <input type="hidden" name="items[0][penggal]" value="<?php echo e($r->penggal); ?>">
                                        <input type="hidden" name="items[0][tahun_kewangan]" value="<?php echo e($r->tahun); ?>">
                                        <input type="hidden" name="tujuan" value="semakan">
                                        <input type="hidden" name="tarikh_permohonan" value="<?php echo e(now()->toDateString()); ?>">
                                        
                                        <input type="hidden" name="pemohon_nama" value="<?php echo e($r->nama_penghantar); ?>">
                                        <input type="hidden" name="pemohon_jawatan" value="<?php echo e($r->jawatan); ?>">
                                        <button type="submit" class="kkk-btn kkk-btn-primary"><?php echo e($t('Hantar permohonan')); ?></button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <script>
            // Row "Hantar permohonan": confirm the applicant's name (pre-filled with the record's Penghantar)
            function kkkPemohon(form) {
                var nama = prompt(<?php echo json_encode($t('Nama Pemohon'), 15, 512) ?>, form.pemohon_nama.value || '');
                if (nama === null || !nama.trim()) return false;
                form.pemohon_nama.value = nama.trim();
                return true;
            }
        </script>

        <?php if($penerimaan->hasPages()): ?>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:12px;font-size:12.5px">
                <span class="kkk-muted"><?php echo e($penerimaan->firstItem()); ?>–<?php echo e($penerimaan->lastItem()); ?> / <?php echo e($penerimaan->total()); ?></span>
                <span style="display:flex;gap:8px">
                    <?php if($penerimaan->onFirstPage()): ?>
                        <span class="kkk-btn kkk-btn-ghost" style="opacity:.45;pointer-events:none">‹ <?php echo e($t('Sebelum')); ?></span>
                    <?php else: ?>
                        <a href="<?php echo e($penerimaan->previousPageUrl()); ?>" class="kkk-btn kkk-btn-ghost">‹ <?php echo e($t('Sebelum')); ?></a>
                    <?php endif; ?>
                    <?php if($penerimaan->hasMorePages()): ?>
                        <a href="<?php echo e($penerimaan->nextPageUrl()); ?>" class="kkk-btn kkk-btn-ghost"><?php echo e($t('Seterusnya')); ?> ›</a>
                    <?php else: ?>
                        <span class="kkk-btn kkk-btn-ghost" style="opacity:.45;pointer-events:none"><?php echo e($t('Seterusnya')); ?> ›</span>
                    <?php endif; ?>
                </span>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<div class="kkk-card" style="padding:0;max-width:960px;margin:20px auto 0">
    <?php if($peminjaman->isEmpty()): ?>
        <div class="kkk-empty"><?php echo e($t('Tiada rekod bagi tempoh ini.')); ?></div>
    <?php else: ?>
        <table class="kkk-table">
            <thead>
                <tr>
                    <th><?php echo e($t('No. Borang')); ?></th>
                    <th><?php echo e($t('Sekolah')); ?></th>
                    <th><?php echo e($t('Jenis KKK')); ?></th>
                    <th><?php echo e($t('Tarikh Permohonan')); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="clickable <?php echo e($selected && $selected->id === $b->id ? 'is-selected' : ''); ?>"
                        onclick="window.location='<?php echo e(route('kkk.rekod', array_filter(['tahun' => $tahun, 'status' => $status, 'jenis' => $jenis, 'pilih' => $b->id]))); ?>'">
                        <td><?php echo e($b->no_borang); ?></td>
                        <td>
                            <?php echo e($b->items->first()?->sekolah?->nama); ?>

                            <?php if($b->items->count() > 1): ?>
                                <span class="kkk-muted">+<?php echo e($b->items->count() - 1); ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(collect($b->jenis)->map($t)->implode(', ')); ?></td>
                        <td><?php echo e($b->tarikh_permohonan->format('d/m/Y')); ?></td>
                        <td>
                            <?php $m = $b->meta($locale); ?>
                            <span class="kkk-badge" style="background:<?php echo e($m['bg']); ?>;color:<?php echo e($m['fg']); ?>"><span class="dot" style="background:<?php echo e($m['dot']); ?>"></span><?php echo e($m['label']); ?></span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.kkk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views/kkk/rekod.blade.php ENDPATH**/ ?>