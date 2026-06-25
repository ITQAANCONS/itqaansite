<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->string('title_ar');
            $table->string('title_en');
            $table->string('category_ar')->nullable();
            $table->string('category_en')->nullable();
            $table->string('client_ar')->nullable();
            $table->string('client_en')->nullable();

            $table->string('url')->nullable();
            $table->string('year')->nullable();
            // website | mobile | webapp | ecommerce | branding | other
            $table->string('platform')->default('website');

            $table->text('excerpt_ar')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();

            $table->json('services')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['is_published', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
