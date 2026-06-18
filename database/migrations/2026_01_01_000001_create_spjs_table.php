<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpjsTable extends Migration
{
    public function up()
    {
        Schema::create('spjs', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('noKadPintar')->nullable();
            $table->string('kodSJ')->nullable();
            $table->string('jantina')->nullable();
            $table->string('tarikhLahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('namaBank')->nullable();
            $table->string('noAkaunBukuBank')->nullable();
            $table->string('tarikhBukuBankActive')->nullable();
            $table->string('cawanganBank')->nullable();
            $table->string('emelPeribadi')->nullable();
            $table->string('emel')->nullable();
            $table->string('noTelefon')->nullable();
            $table->string('noMobile')->nullable();
            $table->string('tap')->nullable();
            $table->string('scp')->nullable();
            $table->string('tarikhMulaBerkhidmat')->nullable();
            $table->string('tarikhJawatanSekarang')->nullable();
            $table->string('lainLainHal')->nullable();
            $table->string('jabatanTempatBertugas')->nullable();
            $table->string('rujukanFile')->nullable();
            $table->string('Text224')->nullable();
            $table->string('Text236')->nullable();
            $table->string('jenisTanggagaji')->nullable();
            $table->string('tanggagajiSebenar')->nullable();
            $table->string('Text228')->nullable();
            $table->string('tarikhMinjamFail')->nullable();
            $table->string('Text163')->nullable();
            $table->string('Text167')->nullable();
            $table->string('tarikhMulaiMemangku')->nullable();
            $table->string('tempatBertugasSekarang')->nullable();
            $table->string('Text171')->nullable();
            $table->string('duaKertasKerjaProjek')->nullable();
            $table->string('kelulusanTertinggi')->nullable();
            $table->string('sijilGuru')->nullable();
            $table->string('sijilKerani')->nullable();
            $table->string('kursusIPA')->nullable();
            $table->string('GO')->nullable();
            $table->string('FR')->nullable();
            $table->string('Text170')->nullable();
            $table->string('Text172')->nullable();
            $table->string('Text169')->nullable();
            $table->string('Text242')->nullable();
            $table->string('Combo251')->nullable();
            $table->string('peruntukanBersara')->nullable();
            $table->string('jawatanBersara')->nullable();
            $table->string('tarikhBersara')->nullable();
            $table->string('tarikhCutiBersara')->nullable();
            $table->string('tarikhTamatKontrak')->nullable();
            $table->string('tatatertib')->nullable();
            $table->string('lainLainHal2')->nullable();
            $table->string('tarikhUlasan')->nullable();
            $table->string('catatanTatatertib')->nullable();
            $table->string('Text260')->nullable();
            $table->string('mulaiActing')->nullable();
            $table->string('teach')->nullable();
            $table->string('gambar')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spjs');
    }
}
