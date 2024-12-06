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
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->default('');
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->default('');
            $table->string('image')->nullable()->default('defaultFiles/user/default_user.webp');
            $table->tinyInteger('type')->default(1); //0: superuser, 1:admin
            $table->tinyInteger('can_be_deleted')->default(1); //Silinebilir mi?
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('delete')->default(0);
            $table->string('create_user_code')->default('1');
            $table->string('update_user_code')->nullable();
            $table->timestamps();
        });

        Schema::create('admin_sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_sessions');
    }
};
