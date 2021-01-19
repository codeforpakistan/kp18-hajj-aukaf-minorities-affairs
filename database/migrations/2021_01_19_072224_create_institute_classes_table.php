<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id');
            $table->foreignId('school_class_id');
            $table->foreignId('institute_id');
            $table->string('class_no');
            $table->string('total_students');
            $table->string('minority_students');
            $table->string('needy_students');
            $table->string('textbook_cost');
            $table->string('boys_uniform');
            $table->string('girls_uniform');
            $table->date('date');
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
        Schema::dropIfExists('institute_classes');
    }
}
