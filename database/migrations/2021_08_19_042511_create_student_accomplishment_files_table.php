<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccomplishmentFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_accomplishment_files', function (Blueprint $table) {
            $table->id('student_accomplishment_file_id');
            $table->foreignId('student_accomplishments_id');
            $table->string('file');
            $table->timestamps();

            $table->foreign('student_accomplishments_id')->references('student_accomplishments_id')->on('student_accomplishments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_accomplishment_files');
        $table->dropForeign('student_accomplishment_submission_id');;
    }
}