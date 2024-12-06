<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('key_values', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('key')->default('');;
            $table->longText('value')->nullable();
            $table->longText('optional_1')->nullable();
            $table->longText('optional_2')->nullable();
            $table->longText('optional_3')->nullable();
            $table->longText('optional_4')->nullable();
            $table->longText('optional_5')->nullable();
            $table->tinyInteger('can_be_deleted')->default(1);
            $table->tinyInteger('delete')->default(0);
            $table->string('create_user_code')->default('1');
            $table->string('update_user_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('key_values');
    }
};
