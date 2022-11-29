<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStyliValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styli_validations', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->string('flag');
            $table->string('country');
            $table->integer('order_id');
            $table->string('status');
            $table->string('coupon_category');
<<<<<<< HEAD
            $table->foreignId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
=======
<<<<<<< HEAD
            $table->foreignId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
=======
            $table->foriegnId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
>>>>>>> e91d089dad28f95bf491c26ce8f1748f2edcc19f
>>>>>>> 99ba96206cf7c767ffb151783b0ca6c84eda5c86
            $table->double('order_value_aed');
            $table->double('affiliate_payout_aed');
            $table->integer('payout_percentage');
            $table->string('new_repeat');
            $table->double('order_value');
            $table->string('order_status');
            $table->string('final_payouts');
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
        Schema::dropIfExists('styli_validations');
    }
}
