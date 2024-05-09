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
        Schema::create('notion_pages', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->tinyText('title');
            $table->unsignedBigInteger('user_id');
            $table->uuid('parent_uuid');
            $table->string('parent_type', 15);
            $table->tinyText('url');
            $table->json('properties');
            $table->json('raw_data');
            $table->boolean('in_trash');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'parent_uuid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notion_pages');
    }
};
