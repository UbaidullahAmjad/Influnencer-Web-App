<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketerHubValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketer_hub_validation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('coupon_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('customer_type')->nullable();
            $table->double('valid_orders')->nullable();
            $table->double('valid_sale')->nullable();
            $table->double('valid_revenue')->nullable();
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
        Schema::dropIfExists('marketer_hub_validation');
    }
}
