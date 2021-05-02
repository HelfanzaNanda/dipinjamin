<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            //disini ada image, masuk tabel media
            $table->foreignId('category_id');
            $table->foreignId('owner_id');
            $table->string('title');
            $table->mediumText('description');
            $table->string('publisher');
            $table->string('writer');
            $table->string('year');
            $table->string('number_of_pages');
            $table->integer('viewer')->default(0);
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
        Schema::dropIfExists('books');
    }
}
