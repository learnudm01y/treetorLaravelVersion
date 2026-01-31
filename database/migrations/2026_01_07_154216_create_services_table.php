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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->string('badge')->nullable();
            $table->string('icon')->nullable(); // FontAwesome icon class (e.g., fas fa-spa)
            $table->string('featured_image')->nullable();
            $table->text('overview')->nullable();
            $table->longText('content')->nullable();
            $table->json('features')->nullable(); // Array of features with icon, title, description
            $table->json('benefits')->nullable(); // Array of benefits with icon, title, description
            $table->json('ideal_for')->nullable(); // Array of ideal clients with icon, title, description
            $table->json('quick_features')->nullable(); // Array of quick feature strings
            $table->enum('price_type', ['fixed', 'custom', 'from', 'contact'])->default('contact');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_note')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('cta_text')->nullable(); // Call to action button text
            $table->text('meta_description')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->integer('sort_order')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
