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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title')->default('');
            $table->string('short_name')->default('');
            $table->longText('description')->default('');
            $table->string('category')->default('');
            $table->string('price_without_vat')->default('');
            $table->string('priceType_without_vat')->default('TRY');
            $table->string('price')->default('');
            $table->string('priceType')->default('TRY');
            $table->string('cargo_company')->default('');
            $table->string('cargo_price')->default('');
            $table->string('cargo_priceType')->default('');
            $table->string('stock')->default(''); //
            $table->string('time')->default(''); // cargo süresi
            $table->tinyInteger('can_be_deleted')->default(1); //Silinebilir mi?
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
        Schema::dropIfExists('products');
    }
};
