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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->bigInteger('pentesting_start_date')->default(0);
            $table->bigInteger('pentesting_end_date')->default(0);
            $table->tinyInteger('record_status')->default(1);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id')->comment('Created By User');

            $table->fullText(['title','description']);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('programs');
    }
};
