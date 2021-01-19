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
            $table->foreignId('user_id');
            $table->foreignId('institute_class_id');
            $table->string('name');
            $table->string('father_name');
            $table->string('husband_name');
            $table->foreignId('religion_id');
            $table->string('cnic');
            $table->string('gender');
            $table->string('domicile');
            $table->foreignId('maritalstatus_id');
            $table->string('gname');
            $table->string('gfather_name');
            $table->string('gcnic');
            $table->string('gcontact');
            $table->string('disease');
            $table->string('dname');
            $table->string('clinic_address');
            $table->string('dcontact');
            $table->string('image');
            $table->string('operator_review');
            $table->string('recommended_by');
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
