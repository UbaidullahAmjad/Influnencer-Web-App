<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArabyAdsValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('araby_ads_validations', function (Blueprint $table) {
            $table->id();
            $table->date('cycle');
            $table->integer('full_count');
            $table->foreignId('brand_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->double('validated_orders');
            $table->double('validated_revenue');
            $table->double('validated_sales_amount_usd');
            $table->integer('bonus');
            $table->integer('fine');
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
        Schema::dropIfExists('araby_ads_validations');
    }
}
