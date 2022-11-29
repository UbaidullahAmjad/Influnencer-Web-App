<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOunassValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ounass_validations', function (Blueprint $table) {
            $table->id();
            $table->string('row_labels');
            $table->string('sum_of_nmv');
            $table->date('date');
<<<<<<< HEAD
            $table->foreignId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
=======
<<<<<<< HEAD
            $table->foreignId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
=======
            $table->foriegnId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
>>>>>>> e91d089dad28f95bf491c26ce8f1748f2edcc19f
>>>>>>> 99ba96206cf7c767ffb151783b0ca6c84eda5c86
            $table->string('status');
            $table->string('country');
            $table->string('new_customer');
            $table->string('category');
            $table->string('designer');
            $table->string('product_name');
            $table->string('gender');
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
        Schema::dropIfExists('ounass_validations');
    }
}
