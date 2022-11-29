<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoshValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shosh_validations', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->foreignId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
=======
<<<<<<< HEAD
            $table->integer('coupon_id');
=======
            $table->foriegnId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
>>>>>>> e91d089dad28f95bf491c26ce8f1748f2edcc19f
>>>>>>> 99ba96206cf7c767ffb151783b0ca6c84eda5c86
            $table->double('valid_sale_amount');
            $table->integer('valid_orders');
            $table->double('valid_revenue');
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
        Schema::dropIfExists('shosh_validations');
    }
}
