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
        Schema::create('finance_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Карманные расходы, ТСИ, Переменные расходы, Постоянные
            $table->string('type'); // Общее, общее в %, по категориям, переменные расходы
            $table->dateTime('from'); // от
            $table->dateTime('till'); // по
            $table->unsignedInteger('total')->default(0); // %, рубли, валюта
            $table->unsignedBigInteger('user_id');
            $table->string('hash')
                ->comment('Для уникального ключа, внутри себя будет содержать значения из остальных колонок, чтобы не плодить 1 большой индекс');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['user_id', 'hash']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_invoices');
    }
};
