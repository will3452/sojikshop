<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInAppNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_app_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->timestamp('received_at')->nullable();
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
        Schema::dropIfExists('in_app_notifications');
    }
}
