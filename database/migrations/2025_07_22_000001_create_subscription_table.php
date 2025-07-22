<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained()->onDelete('cascade');
            $table->string('email');
            $table->timestamps();
            
            $table->unique(['website_id', 'email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};