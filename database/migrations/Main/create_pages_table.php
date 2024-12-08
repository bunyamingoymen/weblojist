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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();

            //Temel işlemler
            $table->string('sub_title')->nullable(); //altbaşlık
            $table->string('title')->default(''); //başlık
            $table->string('short_name')->default(''); //URL, kullanıcı bakaren göreceği url
            $table->string('image')->nullable(); //ana resim
            $table->longText('description')->nullable(); //yazının içeriği
            $table->longText('cover_letter')->nullable(); //giriş kısmı
            $table->string('category')->nullable(); //yazının kategorisi

            //Yorum ve skor işlemleri:
            $table->tinyInteger('can_be_comment')->default(0); //Yorum yapılabilir mi?
            $table->unsignedBigInteger('comment_count')->nullable()->default(0); //Yorum sayısı
            $table->tinyInteger('can_be_scored')->default(0); //Beğenilebilir, beğenilemez
            $table->unsignedTinyInteger('scored_point')->nullable()->default(0); //skor notu ne? (1-10 arası, ya da 1-5)
            $table->unsignedBigInteger('scored_count')->nullable()->default(0); //Toplam kaç kişi puan vermiş?

            //Yorum işlemleri:
            $table->tinyInteger('show_home')->default(0);
            $table->tinyInteger('home_type')->default(0); // 0: Resim sol tarafta, 1: Resim sağ tarafta

            //Sistemsel işlevler:
            $table->tinyInteger('type')->default(2); //1: blog, 2: sayfa, 3: tedarikçiler, 4: galeri
            $table->tinyInteger('can_be_deleted')->default(1); //Silinebilir mi?
            $table->tinyInteger('active')->default(1); //Aktif mi?
            $table->tinyInteger('delete')->default(0); // Silindi mi?
            $table->string('create_user_code')->default('1'); //Oluşturan kullanıcı
            $table->string('update_user_code')->nullable(); //Güncelleyen kullanıcı
            $table->timestamps(); //Kayıt ve güncelleme tarihi.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
