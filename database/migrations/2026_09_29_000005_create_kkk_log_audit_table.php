<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kkk_log_audit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekod_id')->nullable()->constrained('kkk_rekod')->nullOnDelete();
            $table->string('pengguna_nama', 150);
            $table->string('tindakan', 150);
            $table->text('butiran')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kkk_log_audit');
    }
};
