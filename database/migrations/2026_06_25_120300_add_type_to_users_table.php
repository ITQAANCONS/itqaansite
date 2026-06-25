<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // staff = team members who use the /admin panel
            // client = customers who use the /portal panel
            $table->string('type')->default('staff')->after('email')->index();
            $table->string('phone')->nullable()->after('type');
            $table->string('company')->nullable()->after('phone');
            $table->boolean('is_active')->default(true)->after('company');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['type', 'phone', 'company', 'is_active']);
        });
    }
};
