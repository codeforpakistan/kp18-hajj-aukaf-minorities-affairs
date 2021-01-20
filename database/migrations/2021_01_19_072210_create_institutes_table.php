<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('name');
            $table->string('reg_num')->nullable();
            $table->boolean('affiliated_with_board');
            $table->string('photo_of_affiliation')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('institute_type_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('institute_sector')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_number')->nullable();
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
        Schema::dropIfExists('institutes');
    }
}
