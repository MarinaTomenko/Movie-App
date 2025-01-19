<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie_api_requests', function (Blueprint $table) {
            $table->id(); // Автоинкрементный первичный ключ
            $table->unsignedBigInteger('movie_id'); // Целочисленное поле для связи с таблицей movies
            $table->text('json_response')->nullable(); // Текстовое поле для хранения JSON-ответа
            $table->string('status', 10)->nullable(); // Строковое поле для статуса
            $table->string('image_path', 255)->nullable(); // Строковое поле для пути к изображению
            $table->timestamps(); // Поля created_at и updated_at

            // Внешний ключ для связи с таблицей movies
            $table->foreign('movie_id')
                  ->references('id')
                  ->on('movies')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_api_requests');
    }
};