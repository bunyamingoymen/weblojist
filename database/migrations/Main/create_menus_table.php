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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type')->nullable(); //footer veya header
            $table->string('top_category')->nullable()->default(0); //0 ise üst kategori, değilse alt kategori
            $table->string('title')->nullable();
            $table->string('path')->nullable();
            $table->string('row')->nullable(); //satır
            $table->string('column')->nullable(); //sütun
            $table->tinyInteger('open_different_page')->nullable()->default(0);
            $table->tinyInteger('can_be_deleted')->default(1);
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('menus');
    }
};
