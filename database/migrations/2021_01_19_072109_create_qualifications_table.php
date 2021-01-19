<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id');
            $table->foreignId('qualification_level_id');
            $table->string('recent_class');
            $table->string('current_class');
            $table->foreignId('discipline_id');
            $table->foreignId('institute_id');
            $table->foreignId('degree_awarding_id');
            $table->string('education_system');
            $table->string('grading_system');
            $table->double('total_cgpa', 3, 2);
            $table->double('obtained_cgpa', 3, 2);
            $table->integer('total_marks');
            $table->integer('obtained_marks');
            $table->double('percentage', 3, 2);
            $table->date('passing_date');
            $table->boolean('completed');            
            $table->foreignId('created_by');
            $table->foreignId('modified_by');
            $table->foreignId('deleted_by');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('qualifications');
    }
}
