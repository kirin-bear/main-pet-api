<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->text('page')->nullable(false);
            $table->text('referer');

            $table->string('device', 255)->default('');
            $table->string('device_name', 255)->default('');

            $table->string('platform', 255)->default('');
            $table->string('platform_version', 10)->default('');

            $table->string('browser', 255)->default('');
            $table->string('browser_version', 10)->default('');

            $table->string('robot', 255)->default('');

            $table->text('user_agent')->nullable(false);
            $table->timestamp('created_at')->useCurrent()->nullable(false);

            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
