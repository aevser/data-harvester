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
        Schema::create('log_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('log_statuses')->insert(
            [
                [
                    'name' => 'В процессе',
                    'type' => 'in_process',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Успешно',
                    'type' => 'success',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Ошибка',
                    'type' => 'error',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_statuses');
    }
};
