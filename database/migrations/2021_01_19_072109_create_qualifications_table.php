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
            $table->string('recent_class')->nullable();
            $table->string('current_class')->nullable();
            $table->foreignId('discipline_id');
            $table->foreignId('institute_id');
            $table->foreignId('degree_awarding_id')->nullable();
            $table->string('education_system');
            $table->string('grading_system');
            $table->double('total_cgpa', 3, 2)->nullable();
            $table->double('obtained_cgpa', 3, 2)->nullable();
            $table->integer('total_marks')->nullable();
            $table->integer('obtained_marks')->nullable();
            $table->double('percentage', 3, 2);
            $table->date('passing_date')->nullable();
            $table->boolean('completed');
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
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
