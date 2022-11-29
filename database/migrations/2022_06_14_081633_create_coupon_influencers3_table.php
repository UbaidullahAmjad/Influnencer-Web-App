<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponInfluencers3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_influencers3', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("brand_id");
            $table->bigInteger("coupon_id");
            $table->string("code");
            $table->string("orignal_currency");
            $table->date("date");
            $table->string("customer_type");
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
        Schema::dropIfExists('coupon_influencers3');
    }
}
