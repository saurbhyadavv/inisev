<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('post_send_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->unique(['post_id', 'subscription_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_send_logs');
    }
};
