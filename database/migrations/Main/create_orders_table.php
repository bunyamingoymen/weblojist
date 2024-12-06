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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('order_code')->unique();
            $table->string('user_code')->default('');
            $table->string('payment_method')->default('');
            $table->string('receipt_file')->nullable()->default('');
            $table->string('invoice_file')->nullable()->default('');
            $table->longText('price')->nullable();
            $table->longText('price_without_vat')->nullable();
            $table->longText('cargo_price')->nullable();
            $table->string('address_code')->nullable();
            $table->tinyInteger('status'); //-1: İptal Edildi, 0: Ödeme bekleniyor, 1:Onay Bekleniyor, 2: Hazırlanıyor 3: Kargoda, 4: Tamamlandı
            $table->tinyInteger('archive')->default(0); //Sipariş arşivlendi mi?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
