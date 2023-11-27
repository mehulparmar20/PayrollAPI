<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\foundation\Testing\DatabaseMigrations;//changes
return new class extends Migration
{
    use DatabaseMigrations;//changes
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table__plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->integer('price');
            $table->integer('product_id');
            $table->integer('employee_no');
            $table->integer('tax_id');
            $table->string('description');
            $table->timestamp('created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table__plans');
    }
};
