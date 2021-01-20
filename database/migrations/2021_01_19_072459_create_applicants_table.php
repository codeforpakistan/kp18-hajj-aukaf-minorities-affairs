<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('institute_class_id')->nullable();
            $table->string('name');
            $table->string('father_name');
            $table->string('husband_name')->nullable();
            $table->foreignId('religion_id');
            $table->string('cnic');
            $table->string('gender')->nullable();
            $table->string('domicile')->nullable();
            $table->foreignId('maritalstatus_id')->nullable();
            $table->string('gname')->nullable();
            $table->string('gfather_name')->nullable();
            $table->string('gcnic')->nullable();
            $table->string('gcontact')->nullable();
            $table->string('disease')->nullable();
            $table->string('dname')->nullable();
            $table->string('clinic_address')->nullable();
            $table->string('dcontact')->nullable();
            $table->string('image')->nullable();
            $table->string('operator_review')->nullable();
            $table->string('recommended_by')->nullable();
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
        Schema::dropIfExists('applicants');
    }
}
