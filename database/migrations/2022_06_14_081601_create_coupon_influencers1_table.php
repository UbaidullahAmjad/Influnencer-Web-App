<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponInfluencers1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_influencers1', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("brand_id");
            $table->bigInteger("coupon_id");
            $table->string("code");
            $table->string("aov");
            $table->string("sale_amount");
            $table->string("sale_amount_usd");
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
        Schema::dropIfExists('coupon_influencers1');
    }
}
