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
        Schema::create('notion_databases', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->tinyText('title');
            $table->unsignedBigInteger('user_id');
            $table->uuid('parent_uuid');
            $table->string('parent_type', 15);
            $table->tinyText('url');
            $table->json('raw_data');
            $table->boolean('in_trash');
            $table->timestamps();
            $table->softDeletes();

            $table->index('uuid');
            $table->index('parent_uuid');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notion_databases');
    }
};
