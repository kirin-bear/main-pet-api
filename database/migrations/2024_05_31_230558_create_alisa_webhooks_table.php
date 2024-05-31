<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alisa_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('skill_id');
            $table->string('user_id');
            $table->string('application_id');
            $table->json('request');
            $table->json('response')->nullable();
            $table->timestamp('created_at');

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alisa_webhooks');
    }
};
