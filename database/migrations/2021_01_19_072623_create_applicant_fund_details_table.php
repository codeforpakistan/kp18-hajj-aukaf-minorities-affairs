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
            $table->foreignId('fund_category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->string('amount_recived')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('check_number')->nullable();
            $table->date('appling_date')->nullable();
            $table->boolean('selected');
            $table->boolean('distributed');
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
        Schema::dropIfExists('applicant_fund_details');
    }
}
