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
        Schema::create('service_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Section title
            $table->string('icon')->nullable(); // FontAwesome icon class for section
            $table->enum('type', ['list', 'grid', 'text'])->default('list'); // Display type
            $table->json('items')->nullable(); // Array of items with icon, title, description
            $table->longText('content')->nullable(); // Rich text content for text type
            $table->integer('sort_order')->default(0); // Order of section
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_sections');
    }
};
