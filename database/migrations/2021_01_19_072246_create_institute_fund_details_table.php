<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteFundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_fund_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id');
            $table->foreignId('fund_id');
            $table->string('amount_recived')->nullable();
            $table->date('payment_date')->nullable();
            $table->date('appling_date');
            $table->boolean('selected');
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
        Schema::dropIfExists('institute_fund_details');
    }
}
