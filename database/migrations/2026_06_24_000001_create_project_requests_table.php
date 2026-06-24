<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->string('project_type');
            $table->json('services')->nullable();
            $table->text('description');
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();
            $table->string('has_brand')->nullable();
            $table->string('status')->default('new'); // new | in_review | contacted | closed
            $table->text('admin_notes')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_requests');
    }
};
