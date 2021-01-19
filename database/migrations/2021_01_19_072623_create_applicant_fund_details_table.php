<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantFundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_fund_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id');
            $table->foreignId('fund_id');
            $table->foreignId('fund_category_id');
            $table->foreignId('sub_category_id');
            $table->string('amount_recived');
            $table->date('payment_date');
            $table->string('check_number');
            $table->date('appling_date');
            $table->boolean('selected');
            $table->boolean('distributed');
            $table->boolean('selected');
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
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
        Schema::dropIfExists('applicant_fund_details');
    }
}
