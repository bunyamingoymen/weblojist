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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type')->default('product'); //Hangi değeri tutuyor. (Ürünler ...vs.)
            $table->string('type_code')->default(''); //Tuttuğu değerin code değeri nedir?
            $table->string('name')->nullable()->default('');
            $table->string('file')->default(''); //Dosyanın konumu
            $table->string('file_type')->default('img'); //img, mp4 vs...
            $table->tinyInteger('can_be_deleted')->default(1); //Silinebilir mi?
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
        Schema::dropIfExists('files');
    }
};
