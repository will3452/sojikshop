<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('txn_id');
            $table->foreignId('user_id');
            $table->string('payer_email');
            $table->string('payer_first_name')->nullable();
            $table->string('payer_last_name')->nullable();
            $table->string('payment_fee');
            $table->string('payment_gross'); //full amount
            $table->string('payment_type')->nullable();
            $table->string('payment_status');
            $table->string('shipping');
            $table->timestamp('payment_created_at');
            $table->integer('num_cart_items');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
