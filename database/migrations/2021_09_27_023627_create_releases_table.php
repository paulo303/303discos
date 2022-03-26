<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('label_id')->constrained();
            $table->integer('release_num');
            $table->string('cat_num', 20)->unique();
            $table->string('image', 100)->nullable();
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
        Schema::dropIfExists('releases');
    }
}
