<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id');
			$table->integer('provinsi_id');
			$table->string('provinsi');
			$table->integer('kabupaten_id');
			$table->string('kabupaten');
			$table->integer('kecamatan_id');
			$table->string('kecamatan');
			$table->integer('kode_pos');
			$table->text('address');
			$table->string('name')->nullable();
			$table->string('phone')->nullable();
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
        Schema::dropIfExists('delivery_addresses');
    }
}
