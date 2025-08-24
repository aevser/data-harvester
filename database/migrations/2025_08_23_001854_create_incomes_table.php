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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('income_id')->unsigned();
            $table->string('number')->nullable();
            $table->date('date')->nullable();
            $table->date('last_change_date');
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->bigInteger('barcode')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('total_price')->nullable();
            $table->date('date_close')->nullable();
            $table->string('warehouse_name',)->nullable();
            $table->bigInteger('nm_id')->unsigned()->nullable();
            $table->timestamps();

            $table->index(['date', 'warehouse_name']);
            $table->index('nm_id');
            $table->index('barcode');
            $table->index('date_close');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
