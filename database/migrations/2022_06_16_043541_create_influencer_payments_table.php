<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencer_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("influencer_id");
            $table->string("paypal_email");
            $table->string("wallet_id");
            $table->string("bank_name");
            $table->integer("bank_account_no");
            $table->string("account_holder");
            $table->string("iban");
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
        Schema::dropIfExists('influencer_payments');
    }
}
