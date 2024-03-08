<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('transaksi_id')
                ->nullable()
                ->constrained('transaksi')
                ->nullOnDelete();
            $table->string('menu');
            $table->integer("jumlah");
            $table->bigInteger("harga");
            $table->bigInteger("total");
            $table->boolean("status")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
