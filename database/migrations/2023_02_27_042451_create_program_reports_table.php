<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\RequestStatusConstants;
use App\Constants\RecordStatusConstants;
use App\Constants\SeverityConstant;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->tinyInteger('severity')->default(0);
            $table->tinyInteger('request_status')->default(0);
            $table->tinyInteger('record_status')->default(1);
            $table->unsignedBigInteger('program_id')->comment('Many to One Program');
            $table->unsignedBigInteger('user_id')->comment('Many to One User');

            $table->fullText(['title','description']);
            $table->foreign('program_id')->references('id')->on('programs');
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
        Schema::dropIfExists('program_reports');
    }
};
