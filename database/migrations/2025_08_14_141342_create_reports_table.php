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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->uuid('region_uuid')->nullable();
            $table->uuid('department_uuid')->nullable();
            $table->uuid('neighborhood_uuid')->nullable();
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('address')->nullable();
            $table->string('status', 20)->default('pending');
            $table->dateTime('status_changed_at')->nullable();
            $table->uuid('status_changed_by')->nullable();
            $table->timestamps();

            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('created_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('region_uuid')->references('uuid')->on('regions')->onDelete('restrict');
            $table->foreign('department_uuid')->references('uuid')->on('departments')->onDelete('restrict');
            $table->foreign('neighborhood_uuid')->references('uuid')->on('neighborhoods')->onDelete('restrict');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
