<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelfiRssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delfi_rsses', function (Blueprint $table) {
            $table->id();
            $table->integer('news_id');
            $table->string('title')->nullable();
            $table->string('link');
            $table->mediumText('description');
            $table->string('image');
            $table->string('date');
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
        Schema::dropIfExists('delfi_rsses');
    }
}
