<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();

            $table->string('source')->default('manual'); // website_request | contact | manual | referral
            $table->string('stage')->default('new');       // new | contacted | qualified | proposal | won | lost

            $table->decimal('value', 12, 2)->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->date('next_follow_up')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('project_request_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();

            $table->index(['stage', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
