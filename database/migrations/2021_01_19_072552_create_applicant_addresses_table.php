<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id');
            $table->text('current_address');
            $table->text('permenent_address')->nullable();
            $table->foreignId('city_id');
            $table->text('postal_address')->nullable();
            $table->string('zip_code')->nullable();
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
        Schema::dropIfExists('applicant_addresses');
    }
}
