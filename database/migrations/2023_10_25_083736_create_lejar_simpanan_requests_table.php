<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lejar_simpanan_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('purchase_order_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('delivery_order_id')
                ->nullable()
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('srv_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('borang_penyerahan_id')
                ->nullable()
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

            $table->string('moe_reference')
                ->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

            $table->foreignId('sk_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

            $table->string('sk_confirmed')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lejar_simpanan_requests');
    }
};
