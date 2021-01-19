<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('fund_category_id');
            $table->foreignId('sub_category_id');
            $table->string('total_amount');
            $table->date('receiving_date');
            $table->string('amount_remaining');
            $table->date('last_date');
            $table->year('fund_for_year');
            $table->double('institute_students', 8, 3);
            $table->boolean('active');
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
        Schema::dropIfExists('funds');
    }
}
