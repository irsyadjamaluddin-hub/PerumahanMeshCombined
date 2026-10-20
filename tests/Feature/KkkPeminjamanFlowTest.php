<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Kkk\KkkPeminjaman;
use App\Models\Kkk\KkkSekolah;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KkkPeminjamanFlowTest extends TestCase
{
    use DatabaseTransactions;

    protected function as(string $role)
    {
        return $this->withoutMiddleware(VerifyCsrfToken::class)->withSession(['kkk_role' => $role]);
    }

    public function test_full_borang_workflow(): void
    {
        $sekolah = KkkSekolah::where('aktif', true)->firstOrFail();
        $today = now()->toDateString();

        // Pemohon submits.
        $this->as('pemohon')->post(route('kkk.rekod.store'), [
            'jenis' => ['Yuran', 'Kantin'],
            'tujuan' => 'semakan',
            'tarikh_permohonan' => $today,
            'pemohon_nama' => 'Ali Test',
            'pemohon_jawatan' => 'Juruaudit',
            'items' => [['sekolah_id' => $sekolah->id, 'penggal' => '1', 'tahun_kewangan' => now()->year], ['sekolah_id' => '']],
        ])->assertRedirect()->assertSessionHas('kkk_berjaya');

        $b = KkkPeminjaman::latest('id')->firstOrFail();
        $this->assertSame('dipohon', $b->status);
        $this->assertSame(1, $b->items()->count());

        // Wrong role can't approve.
        $this->as('pemohon')->post(route('kkk.rekod.langkah', [$b, 'benarkan']), [])->assertSessionHas('kkk_ralat');

        $sign = fn ($prefix, $tarikh) => [$prefix.'_nama' => 'X '.$prefix, $prefix.'_jawatan' => 'J', $tarikh => $today];

        $this->as('ketua_sub')->post(route('kkk.rekod.langkah', [$b, 'benarkan']), $sign('dibenarkan', 'tarikh_dibenarkan'))->assertSessionHas('kkk_berjaya');
        $this->assertSame('dibenarkan', $b->fresh()->status);

        $this->as('pengawas')->post(route('kkk.rekod.langkah', [$b, 'keluarkan']), $sign('dikeluarkan', 'tarikh_dikeluarkan'))->assertSessionHas('kkk_berjaya');
        $this->assertSame('dikeluarkan', $b->fresh()->status);

        // A second borang for the same school/type can't be issued while the first is out.
        $this->as('pemohon')->post(route('kkk.rekod.store'), [
            'jenis' => ['Yuran'], 'tujuan' => 'lain', 'tujuan_lain' => 'Siasatan', 'tarikh_permohonan' => $today,
            'pemohon_nama' => 'B', 'items' => [['sekolah_id' => $sekolah->id, 'penggal' => '', 'tahun_kewangan' => now()->year]],
        ]);
        $b2 = KkkPeminjaman::latest('id')->firstOrFail();
        $this->as('ketua_sub')->post(route('kkk.rekod.langkah', [$b2, 'benarkan']), $sign('dibenarkan', 'tarikh_dibenarkan'));
        $this->as('pengawas')->post(route('kkk.rekod.langkah', [$b2, 'keluarkan']), $sign('dikeluarkan', 'tarikh_dikeluarkan'))->assertSessionHas('kkk_ralat');
        $this->assertSame('dibenarkan', $b2->fresh()->status);

        $this->as('pemohon')->post(route('kkk.rekod.langkah', [$b, 'terima']), $sign('diterima', 'tarikh_diterima'))->assertSessionHas('kkk_berjaya');
        $this->as('pemohon')->post(route('kkk.rekod.langkah', [$b, 'kembalikan']), $sign('dikembalikan', 'tarikh_dikembalikan'))->assertSessionHas('kkk_berjaya');
        $this->as('pengawas')->post(route('kkk.rekod.langkah', [$b, 'terima-stor']), $sign('diterima_stor', 'tarikh_diterima_stor') + ['catatan_semakan' => 'Lengkap'])->assertSessionHas('kkk_berjaya');
        $this->assertSame('selesai', $b->fresh()->status);

        // Now the second one can go out.
        $this->as('pengawas')->post(route('kkk.rekod.langkah', [$b2, 'keluarkan']), $sign('dikeluarkan', 'tarikh_dikeluarkan'))->assertSessionHas('kkk_berjaya');

        // Rejection path needs a reason.
        $this->as('pemohon')->post(route('kkk.rekod.store'), [
            'jenis' => ['Rampaian'], 'tujuan' => 'pengauditan', 'tarikh_permohonan' => $today,
            'pemohon_nama' => 'C', 'items' => [['sekolah_id' => $sekolah->id, 'penggal' => '2', 'tahun_kewangan' => now()->year]],
        ]);
        $b3 = KkkPeminjaman::latest('id')->firstOrFail();
        $this->as('ketua_sub')->post(route('kkk.rekod.langkah', [$b3, 'tolak']), $sign('dibenarkan', 'tarikh_dibenarkan'))->assertSessionHasErrors('sebab_ditolak');
        $this->as('ketua_sub')->post(route('kkk.rekod.langkah', [$b3, 'tolak']), $sign('dibenarkan', 'tarikh_dibenarkan') + ['sebab_ditolak' => 'Tidak lengkap']);
        $this->assertSame('ditolak', $b3->fresh()->status);

        // Every page renders for the roles allowed on it, in both languages.
        foreach (['pemohon', 'ketua_sub', 'pengawas'] as $role) {
            foreach (['ms', 'en'] as $lang) {
                $this->withSession(['kkk_role' => $role, 'kkk_locale' => $lang])->get(route('kkk.rekod', ['pilih' => $b->id]))->assertOk()->assertSee($b->no_borang);
                $this->withSession(['kkk_role' => $role, 'kkk_locale' => $lang])->get(route('kkk.rekod', ['pilih' => $b2->id]))->assertOk();
                $this->withSession(['kkk_role' => $role, 'kkk_locale' => $lang])->get(route('kkk.borang', ['pilih' => $b->id]))->assertOk()->assertSee('Lengkap');
            }
        }
        foreach (['ketua_sub', 'pengawas'] as $role) {
            foreach (['kkk.dashboard', 'kkk.exec', 'kkk.sekolah', 'kkk.audit'] as $page) {
                $this->withSession(['kkk_role' => $role])->get(route($page))->assertOk();
            }
        }
        $this->withSession(['kkk_role' => 'pemohon'])->get(route('kkk.dashboard'))->assertRedirect(route('kkk.rekod'));
        $this->withSession(['kkk_role' => 'pengawas'])->get(route('kkk.import'))->assertOk();
        $this->withSession(['kkk_role' => 'kerani'])->get(route('kkk.rekod'))->assertOk(); // stale old role falls back
        $this->withSession(['kkk_role' => 'pemohon'])->get(route('kkk.borang'))->assertOk();
    }

    public function test_pemeriksaan_workflow_and_pencapaian_counts(): void
    {
        $tahun = 2099; // a year with no real data, so the counts below are exact
        $sekolah = KkkSekolah::where('aktif', true)->firstOrFail();
        $aktif = KkkSekolah::where('aktif', true)->count();
        $today = now()->toDateString();

        // Pemohon can't see examination pages.
        $this->withSession(['kkk_role' => 'pemohon'])->get(route('kkk.pemeriksaan'))->assertRedirect(route('kkk.rekod'));
        $this->withSession(['kkk_role' => 'pemohon'])->get(route('kkk.pencapaian'))->assertRedirect(route('kkk.rekod'));

        // Generate expected accounts: 3 per active school, all "Tidak diterima".
        $this->as('pengawas')->post(route('kkk.pemeriksaan.jana'), ['tahun_kewangan' => $tahun, 'penggal' => 1])->assertSessionHas('kkk_berjaya');
        $rekods = \App\Models\Kkk\KkkRekod::where('tahun_kewangan', $tahun)->get();
        $this->assertCount($aktif * 3, $rekods);
        $this->assertTrue($rekods->every(fn ($r) => $r->status === 'belum_diterima'));

        $yuran = $rekods->first(fn ($r) => $r->sekolah_id == $sekolah->id && $r->kategori === 'Yuran');
        $kantin = $rekods->first(fn ($r) => $r->sekolah_id == $sekolah->id && $r->kategori === 'Kantin');

        // Yuran: received → query → reply → TFV. Kantin: received → query (left open).
        $this->as('pengawas')->post(route('kkk.pemeriksaan.terima', $yuran), ['tarikh_diterima' => $today])->assertSessionHas('kkk_berjaya');
        $this->as('pengawas')->post(route('kkk.pemeriksaan.kuiri', $yuran), ['tarikh_dihadapkan' => $today])->assertSessionHas('kkk_berjaya');
        $this->as('pengawas')->post(route('kkk.pemeriksaan.tfv', $yuran), ['tarikh_tfv' => $today])->assertSessionHas('kkk_ralat'); // query still open
        $this->as('pengawas')->post(route('kkk.pemeriksaan.jawapan', $yuran), ['tarikh_jawapan' => $today])->assertSessionHas('kkk_berjaya');
        $this->as('pengawas')->post(route('kkk.pemeriksaan.tfv', $yuran), ['tarikh_tfv' => $today])->assertSessionHas('kkk_berjaya');
        $this->assertSame('selesai', $yuran->fresh()->status);

        $this->as('ketua_sub')->post(route('kkk.pemeriksaan.terima', $kantin), ['tarikh_diterima' => $today]);
        $this->as('ketua_sub')->post(route('kkk.pemeriksaan.kuiri', $kantin), ['tarikh_dihadapkan' => $today]);
        $this->assertSame('dalam_kuiri', $kantin->fresh()->status);

        // Only Ketua Sub Unit may reopen a locked record.
        $this->as('pengawas')->post(route('kkk.pemeriksaan.reopen', $yuran), ['sebab' => 'x'])->assertSessionHas('kkk_ralat');
        $this->as('ketua_sub')->post(route('kkk.pemeriksaan.reopen', $yuran), ['sebab' => 'Betulkan tarikh'])->assertSessionHas('kkk_berjaya');
        $this->as('pengawas')->post(route('kkk.pemeriksaan.tfv', $yuran), ['tarikh_tfv' => $today]);

        // Duplicate registration is refused; a blank received date registers an expected account.
        $this->as('pengawas')->post(route('kkk.pemeriksaan.store'), ['sekolah_id' => $sekolah->id, 'tahun_kewangan' => $tahun, 'penggal' => 1, 'kategori' => 'Yuran'])->assertSessionHas('kkk_ralat');
        $this->as('pengawas')->post(route('kkk.pemeriksaan.store'), ['sekolah_id' => $sekolah->id, 'tahun_kewangan' => $tahun, 'penggal' => 2, 'kategori' => 'Rampaian', 'tarikh_diterima' => $today])->assertSessionHas('kkk_berjaya');

        // Pencapaian for that year only, all clusters.
        $res = $this->withSession(['kkk_role' => 'ketua_sub'])->get(route('kkk.pencapaian', ['dari' => $tahun, 'hingga' => $tahun, 'kluster_dari' => 0, 'kluster_hingga' => 99]))->assertOk();
        $kad = $res->viewData('kad');
        $jumlah = $aktif * 3 + 1;
        $this->assertSame(['jumlah' => $jumlah, 'tfv' => 1, 'kueri' => 1, 'belum' => 1, 'tidak' => $jumlah - 3], $kad['Jumlah']);
        $this->assertSame(1, $kad['Yuran']['tfv']);
        $this->assertSame(1, $kad['Kantin']['kueri']);
        $this->assertSame(1, $kad['Rampaian']['belum']);

        foreach (['ms', 'en'] as $lang) {
            $this->withSession(['kkk_role' => 'pengawas', 'kkk_locale' => $lang])->get(route('kkk.pencapaian'))->assertOk();
            $this->withSession(['kkk_role' => 'pengawas', 'kkk_locale' => $lang])->get(route('kkk.pemeriksaan', ['tahun_kewangan' => $tahun, 'pilih' => $yuran->id]))->assertOk()->assertSee($sekolah->nama);
            $this->withSession(['kkk_role' => 'ketua_sub', 'kkk_locale' => $lang])->get(route('kkk.pemeriksaan', ['tahun_kewangan' => $tahun, 'pilih' => $kantin->id]))->assertOk();
            $this->withSession(['kkk_role' => 'ketua_sub', 'kkk_locale' => $lang])->get(route('kkk.audit'))->assertOk();
        }
        $this->assertSame('kueri', \App\Models\Kkk\KkkRekod::kumpulanPencapaian('kuiri_dihantar'));
        $this->assertSame('belum', \App\Models\Kkk\KkkRekod::kumpulanPencapaian('dalam_semakan_pemeriksa1'));
    }
}
