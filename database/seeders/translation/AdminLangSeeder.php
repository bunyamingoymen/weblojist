<?php

namespace Database\Seeders\translation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminLangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminTexts = [
            'Page Not Found' => [
                'tr' => 'Sayfa Bulunamadı',
                'en' => 'Page Not Found',
            ],
            'Category' => [
                'tr' => 'Kategori',
                'en' => 'Category',
            ],
            'Active' => [
                'tr' => 'Aktif',
                'en' => 'Active',
            ],
            'Category Name' => [
                'tr' => 'Kategori İsmi',
                'en' => 'Category Name',
            ],
            'Name' => [
                'tr' => 'İsim',
                'en' => 'Name',
            ],
            'Select Category' => [
                'tr' => 'Kategori Seçiniz',
                'en' => 'Select Category',
            ],
            'Stock' => [
                'tr' => 'Stok',
                'en' => 'Stock',
            ],
            'Cargo Time' => [
                'tr' => 'Kargo Süresi',
                'en' => 'Cargo Time',
            ],
            'You must log in first' => [
                'tr' => 'İlk önce giriş yapmanız gerekmektedir',
                'en' => 'You must log in first',
            ],
            'Previously logged in' => [
                'tr' => 'Daha önce giriş yapılmış',
                'en' => 'Previously logged in',
            ],
            'Sign in to continue' => [
                'tr' => 'Daha önce giriş yapılmış',
                'en' => 'Sign in to continue',
            ],
            'Username' => [
                'tr' => 'Kullanıcı Adı',
                'en' => 'Username',
            ],
            'Password' => [
                'tr' => 'Şifre',
                'en' => 'Password',
            ],
            'Repeat password' => [
                'tr' => 'Şifre Tekrarı',
                'en' => 'Repeat password',
            ],
            'E-Mail' => [
                'tr' => 'E-Mail',
                'en' => 'E-Mail',
            ],
            'Enter username or email' => [
                'tr' => 'Kullanıcı adı yada email adresi giriniz',
                'en' => 'Enter username or email',
            ],
            'Enter password' => [
                'tr' => 'Şifre giriniz',
                'en' => 'Enter password',
            ],
            'Log In' => [
                'tr' => 'Giriş Yap',
                'en' => 'Log In',
            ],
            'Successfully logged in' => [
                'tr' => 'Başarılı bir şekilde giriş yapıldı',
                'en' => 'Successfully logged in',
            ],
            'Username or password is incorrect' => [
                'tr' => 'Kullanıcı adı ya da şifre hatalı',
                'en' => 'Username or password is incorrect',
            ],
            'User updated successfully' => [
                'tr' => 'Kullanıcı başarılı bir şekilde güncellendi',
                'en' => 'User updated successfully',
            ],
            'User added successfully' => [
                'tr' => 'Kullanıcı başarılı bir şekilde eklendi',
                'en' => 'User added successfully',
            ],
            'An error occurred while updating users' => [
                'tr' => 'Kullanıcılar güncellenirken bir hata meydana geldi',
                'en' => 'An error occurred while updating users',
            ],

            'An error occurred (Product Image)' => [
                'tr' => 'Bir hata meydana geldi (Ürünler Resim)',
                'en' => 'An error occurred (Product Image)',
            ],
            'Post is not supported' => [
                'tr' => 'Post desteklenmemektedir',
                'en' => 'Post is not supported',
            ],
            'Home' => [
                'tr' => 'Anasayfa',
                'en' => 'Home',
            ],
            'Users' => [
                'tr' => 'Kullanıcılar',
                'en' => 'Users',
            ],
            'User Create' => [
                'tr' => 'Kullanıcı Oluştur',
                'en' => 'User Create',
            ],
            'Menu' => [
                'tr' => 'Menü',
                'en' => 'Menu',
            ],
            'Management' => [
                'tr' => 'Yönetim',
                'en' => 'Management',
            ],
            'Settings' => [
                'tr' => 'Ayarlar',
                'en' => 'Settings',
            ],
            'Meta Tags' => [
                'tr' => 'Meta Etiketleri',
                'en' => 'Meta Tags',
            ],
            'Meta Tag' => [
                'tr' => 'Meta Etiketi',
                'en' => 'Meta Tag',
            ],
            'Admin Meta Tags' => [
                'tr' => 'Admin Meta Etiketleri',
                'en' => 'Admin Meta Tags',
            ],
            'Backgrounds' => [
                'tr' => 'Arkaplanlar',
                'en' => 'Backgrounds',
            ],
            'Descriptions' => [
                'tr' => 'Açıklamalar',
                'en' => 'Descriptions',
            ],
            'Description' => [
                'tr' => 'Açıklama',
                'en' => 'Description',
            ],
            'Enter Description' => [
                'tr' => 'Açıklama Giriniz',
                'en' => 'Enter Description',
            ],
            'Main Title' => [
                'tr' => 'Ana Başlık',
                'en' => 'Main Title',
            ],
            'Main Description' => [
                'tr' => 'Ana Açıklama',
                'en' => 'Main Description',
            ],
            'Main Sub Title' => [
                'tr' => 'Ana Alt Başlık',
                'en' => 'Main Sub Title',
            ],
            'Enter Main Title' => [
                'tr' => 'Ana Başlık Giriniz',
                'en' => 'Enter Main Title',
            ],
            'Enter Main Sub Title' => [
                'tr' => 'Ana Alt Başlık Giriniz',
                'en' => 'Enter Main Sub Title',
            ],
            'Enter Main Description' => [
                'tr' => 'Ana Açıklama Giriniz',
                'en' => 'Enter Main Description',
            ],
            'FAQ' => [
                'tr' => 'SSS',
                'en' => 'FAQ',
            ],
            'FAQ' => [
                'tr' => 'SSS',
                'en' => 'FAQ',
            ],
            'Logos' => [
                'tr' => 'Logolar',
                'en' => 'Logos',
            ],
            'Contact Information' => [
                'tr' => 'İletişim Bilgileri',
                'en' => 'Contact Information',
            ],
            'Address' => [
                'tr' => 'Adres',
                'en' => 'Address',
            ],
            'Enter Address' => [
                'tr' => 'Adres Giriniz',
                'en' => 'Enter Address',
            ],
            'Menus' => [
                'tr' => 'Menüler',
                'en' => 'Menus',
            ],
            'Menus' => [
                'tr' => 'Menüler',
                'en' => 'Menus',
            ],
            'Payment Methods' => [
                'tr' => 'Ödeme Yöntemleri',
                'en' => 'Payment Methods',
            ],
            'Social Media Links' => [
                'tr' => 'Sosyal Medya Linkleri',
                'en' => 'Social Media Links',
            ],
            'Key Value' => [
                'tr' => 'Key Value',
                'en' => 'Key Value',
            ],
            'Members' => [
                'tr' => 'Üyeler',
                'en' => 'Members',
            ],
            'Datas' => [
                'tr' => 'Veriler',
                'en' => 'Datas',
            ],
            'Contact' => [
                'tr' => 'İletişim',
                'en' => 'Contact',
            ],
            'Blog' => [
                'tr' => 'Blog',
                'en' => 'Blog',
            ],
            'Categories' => [
                'tr' => 'Kategoriler',
                'en' => 'Categories',
            ],
            'Category Type' => [
                'tr' => 'Kategori tipi',
                'en' => 'Category Type',
            ],
            'Pages' => [
                'tr' => 'Sayfalar',
                'en' => 'Pages',
            ],
            'Products' => [
                'tr' => 'Ürünler',
                'en' => 'Products',
            ],
            'Order' => [
                'tr' => 'Sipariş',
                'en' => 'Order',
            ],
            'Orders' => [
                'tr' => 'Siparişler',
                'en' => 'Orders',
            ],
            'Other' => [
                'tr' => 'Diğer',
                'en' => 'Other',
            ],
            'Cargo Companies' => [
                'tr' => 'Kargo Firmaları',
                'en' => 'Cargo Companies',
            ],
            'Cargo Company' => [
                'tr' => 'Kargo Firması',
                'en' => 'Cargo Company',
            ],
            'Select Cargo Company' => [
                'tr' => 'Kargo Firması Seçiniz',
                'en' => 'Select Cargo Company',
            ],
            'Cargo Company Name' => [
                'tr' => 'Kargo Firması İsmi',
                'en' => 'Cargo Company Name',
            ],
            'Cargo Company Photo' => [
                'tr' => 'Kargo Firması Fotoğrafı',
                'en' => 'Cargo Company Photo',
            ],
            'IBAN Informaitons' => [
                'tr' => 'IBAN Bilgileri',
                'en' => 'IBAN Informaitons',
            ],
            'IBAN' => [
                'tr' => 'IBAN',
                'en' => 'IBAN',
            ],
            'Sub Title' => [
                'tr' => 'Alt Başlık',
                'en' => 'Sub Title',
            ],
            'Show On Homepage' => [
                'tr' => 'Anasayfada Göster',
                'en' => 'Show On Homepage',
            ],
            'If it is shown on the homepage, the image should be on the right side (If this is not selected, it will be on the left side.)' => [
                'tr' => 'Anasayfa da gösterilirse resim sağ tarafta olsun (Bu seçilemezse sol tarafta olur.)',
                'en' => 'If it is shown on the homepage, the image should be on the right side (If this is not selected, it will be on the left side.)',
            ],
            'Process' => [
                'tr' => 'Süreçler',
                'en' => 'Process',
            ],
            'Services' => [
                'tr' => 'Servisler',
                'en' => 'Services',
            ],
            'Bank Name' => [
                'tr' => 'Banka İsmi',
                'en' => 'Bank Name',
            ],
            'Customer References' => [
                'tr' => 'Müşteri Referansları',
                'en' => 'Customer References',
            ],
            'An error occurred (Key Value)' => [
                'tr' => 'Bir hata meydana geldi (Key Value)',
                'en' => 'An error occurred (Key Value)',
            ],
            'An error occurred while registering the user' => [
                'tr' => 'Kullanıcı kaydedilirken bir hata meydana geldi',
                'en' => 'An error occurred while registering the user',
            ],
            'Please enter a valid email address' => [
                'tr' => 'Lütfen geçerli bir mail adresi giriniz',
                'en' => 'Please enter a valid email address',
            ],
            'Password and Repeat Password do not match' => [
                'tr' => 'Şifre ile Şifre Tekrarı uyuşmamaktadır',
                'en' => 'Password and Repeat Password do not match',
            ],
            'Please fill in the required fields' => [
                'tr' => 'Lütfen gerekli alanları doldurunuz',
                'en' => 'Please fill in the required fields',
            ],

            'Empty fields' => [
                'tr' => 'Boş Alanlar',
                'en' => 'Empty fields',
            ],

            'Error!' => [
                'tr' => 'Hata!',
                'en' => 'Error!',
            ],
            'Updated' => [
                'tr' => 'Güncellendi',
                'en' => 'Updated',
            ],
            'Site Title' => [
                'tr' => 'Site Başlığı',
                'en' => 'Site Title',
            ],
            'Enter Title' => [
                'tr' => 'Başlık Giriniz',
                'en' => 'Enter Title',
            ],
            'Enter Icon' => [
                'tr' => 'İkon Giriniz',
                'en' => 'Enter Icon',
            ],
            'Icon' => [
                'tr' => 'İkon',
                'en' => 'Icon',
            ],
            'Introduction' => [
                'tr' => 'Tanıtım Yazısı',
                'en' => 'Introduction',
            ],
            'Enter Introduction' => [
                'tr' => 'Tanıtım Yazısı Giriniz',
                'en' => 'Enter Introduction',
            ],
            'Save' => [
                'tr' => 'Kaydet',
                'en' => 'Save',
            ],
            'Money Order' => [
                'tr' => 'Havale/EFT',
                'en' => 'Money Order',
            ],
            'Credit Cart' => [
                'tr' => 'Kredi Kartı',
                'en' => 'Credit Cart',
            ],
            'Enter Link' => [
                'tr' => 'Link Giriniz',
                'en' => 'Enter Link',
            ],
            'New' => [
                'tr' => 'Yeni',
                'en' => 'New',
            ],
            'This value cannot be deleted' => [
                'tr' => 'Bu değer silinemez',
                'en' => 'This value cannot be deleted',
            ],
            'Deleted' => [
                'tr' => 'Silindi',
                'en' => 'Deleted',
            ],
            'Cancel' => [
                'tr' => 'Vazgeç',
                'en' => 'Cancel',
            ],

            'Choose file...' => [
                'tr' => 'Dosya Seçiniz...',
                'en' => 'Choose file...'
            ],

            'Choose files...' => [
                'tr' => 'Dosyaları Seçiniz...',
                'en' => 'Choose files...'
            ],

            'This logo is the logo that will appear on your home page' => [
                'tr' => 'Bu logo ana sayfanızda gözükecek olan logodur',
                'en' => 'This logo is the logo that will appear on your home page'
            ],

            'This logo is the logo that will appear when members log in' => [
                'tr' => 'Bu logo üyeler giriş yaparken gözükecek logodur',
                'en' => 'This logo is the logo that will appear when members log in',
            ],

            'This logo is the logo that will appear when members log in' => [
                'tr' => 'Bu logo üyeler giriş yaparken gözükecek logodur',
                'en' => 'This logo is the logo that will appear when members log in',
            ],

            'This logo is the logo that will appear after members log in' => [
                'tr' => 'Bu logo üyeler giriş yaptıktan sonra gözükecek logodur',
                'en' => 'This logo is the logo that will appear after members log in'
            ],

            'This logo is the logo that appears on the admin page' => [
                'tr' => 'Bu logo admin sayfasında gözüken logodur',
                'en' => 'This logo is the logo that appears on the admin page'
            ],

            'This logo is the logo that the admin user sees when logging in' => [
                'tr' => 'Bu logo admin kullanıcısının giriş yaparken gördüğü logodur',
                'en' => 'This logo is the logo that the admin user sees when logging in'
            ],

            'Home Logo' => [
                'tr' => 'Anasayfa Logosu',
                'en' => 'Home Logo'
            ],

            'Home Logo White' => [
                'tr' => 'Beyaz Anasayfa Logosu',
                'en' => 'Home Logo White'
            ],

            'Home Logo Dark' => [
                'tr' => 'Siyah Anasayfa Logosu',
                'en' => 'Home Logo Dark'
            ],

            'Login Logo' => [
                'tr' => 'Giriş Logosu',
                'en' => 'Login Logo'
            ],

            'Member Logo' => [
                'tr' => 'Üye Logosu',
                'en' => 'Member Logo'
            ],

            'Admin Logo' => [
                'tr' => 'Admin Logosu',
                'en' => 'Admin Logo'
            ],

            'Admin Login Logo' => [
                'tr' => 'Admin Giriş Logosu',
                'en' => 'Admin Login Logo'
            ],
            'Video' => [
                'tr' => 'Video',
                'en' => 'Video'
            ],
            'Picture' => [
                'tr' => 'Resim',
                'en' => 'Picture'
            ],
            'Choose Picture' => [
                'tr' => 'Resim Seçiniz',
                'en' => 'Choose Picture'
            ],
            'Choose Pictures' => [
                'tr' => 'Resimleri Seçiniz',
                'en' => 'Choose Pictures'
            ],
            'Slider' => [
                'tr' => 'Slider',
                'en' => 'Slider'
            ],
            'Your browser does not support the video tag' => [
                'tr' => 'Tarayıcınız video etiketini desteklemiyor',
                'en' => 'Your browser does not support the video tag'
            ],

            'You can only upload .mp4 files' => [
                'tr' => 'Yalnızca .mp4 dosyaları yükleyebilirsiniz',
                'en' => 'You can only upload .mp4 files',
            ],

            'The file size must not exceed 5MB' => [
                'tr' => "Dosya boyutu 5MB'ı aşmamalıdır",
                'en' => 'The file size must not exceed 5MB'
            ],

            'Not found file' => [
                'tr' => "Dosya bulunamadı",
                'en' => 'Not found file'
            ],

            'You do not have access authorization' => [
                'tr' => "Erişim yetkiniz bulunmamaktadır",
                'en' => 'You do not have access authorization'
            ],

            'Language changed successfully' => [
                'tr' => "Dil başarılı bir şekilde değiştirildi",
                'en' => 'Language changed successfully'
            ],

            'An error occurred while changing the language' => [
                'tr' => 'Dil değiştirilirken bir hata meydana geldi',
                'en' => 'An error occurred while changing the language'
            ],

            'Account owner' => [
                'tr' => 'Hesap sahibi',
                'en' => 'Account owner'
            ],

            'Question' => [
                'tr' => 'Soru',
                'en' => 'Question'
            ],

            'Answer' => [
                'tr' => 'Cevap',
                'en' => 'Answer'
            ],

            'Enter Question' => [
                'tr' => 'Soru Giriniz',
                'en' => 'Enter Question'
            ],

            'Enter Answer' => [
                'tr' => 'Cevap Giriniz',
                'en' => 'Enter Answer'
            ],

            'Approve' => [
                'tr' => 'Onayla',
                'en' => 'Approve'
            ],

            'Are you sure' => [
                'tr' => 'Emin misiniz?',
                'en' => 'Are you sure?'
            ],

            'Do you want to delete this data' => [
                'tr' => 'Bu veriyi silmek istiyor musunuz?',
                'en' => 'Do you want to delete this data?'
            ],

            'Created' => [
                'tr' => 'Oluşturuldu',
                'en' => 'Created',
            ],

            'Title' => [
                'tr' => 'Başlık',
                'en' => 'Title'
            ],
            'Actions' => [
                'tr' => 'İşlemler',
                'en' => 'Actions'
            ],

            'Update' => [
                'tr' => 'Güncelle',
                'en' => 'Sil'
            ],

            'Delete' => [
                'tr' => 'Sil',
                'en' => 'Delete'
            ],

            'Blog Create / Edit' => [
                'tr' => 'Blog Oluştur / Güncelle',
                'en' => 'Blog Create / Edit'
            ],

            'Supplier Create / Edit' => [
                'tr' => 'Tedarikçi Oluştur / Güncelle',
                'en' => 'Supplier Create / Edit'
            ],

            'Page Create / Edit' => [
                'tr' => 'Sayfa Oluştur / Güncelle',
                'en' => 'Page Create / Edit'
            ],

            'An error occurred (Page)' => [
                'tr' => 'Bir hata meydana geldi (Page)',
                'en' => 'An error occurred (Page)'
            ],

            'Content' => [
                'tr' => 'İçerik',
                'en' => 'Content'
            ],

            'Image' => [
                'tr' => 'Resim',
                'en' => 'Image'
            ],

            'Icon' => [
                'tr' => 'İkon',
                'en' => 'Icon'
            ],

            'This logo will appear at the top of the tab' => [
                'tr' => 'Bu logo sekmede en üst kısımda gözükecek',
                'en' => 'This logo will appear at the top of the tab'
            ],

            'Logout Successfully' => [
                'tr' => 'Çıkış Başarılı',
                'en' => 'Logout Successfully'
            ],

            'Logout' => [
                'tr' => 'Çıkış Yap',
                'en' => 'Logout'
            ],

            'Profile' => [
                'tr' => 'Profil',
                'en' => 'Profile'
            ],

            'Product' => [
                'tr' => 'Ürün',
                'en' => 'Product'
            ],

            'Blog' => [
                'tr' => 'Blog',
                'en' => 'Blog'
            ],
            'Product Create / Edit' => [
                'tr' => 'Ürün Oluştur / Güncelle',
                'en' => 'Product Create / Edit'
            ],

            'User Create / Edit' => [
                'tr' => 'Kullanıcı Oluştur / Güncelle',
                'en' => 'User Create / Edit'
            ],

            'Price' => [
                'tr' => 'Ücret',
                'en' => 'Price'
            ],

            'Price Type' => [
                'tr' => 'Ücret Tipi',
                'en' => 'Price Type'
            ],

            'Select Price Type' => [
                'tr' => 'Ücret Tipi Seçiniz',
                'en' => 'Select Price Type'
            ],
            'Contact Title' => [
                'tr' => 'İletişim Başlığı',
                'en' => 'Contact Title'
            ],
            'Contact Sub Title' => [
                'tr' => 'İletişim Alt Başlığı',
                'en' => 'Contact Sub Title'
            ],

            'Enter Contact Title' => [
                'tr' => 'İletişim Başlığı Giriniz',
                'en' => 'Enter Contact Title'
            ],
            'Enter Contact Sub Title' => [
                'tr' => 'İletişim Alt Başlığı Giriniz',
                'en' => 'Contact Sub Title'
            ],

            'Phones' => [
                'tr' => 'Telefon Numaraları',
                'en' => 'Phones'
            ],
            'E-mail Addresses' => [
                'tr' => 'E-Mail Adresleri',
                'en' => 'E-mail Addresses'
            ],

            'Phone Number Name' => [
                'tr' => 'Telefon Numarası İsmi',
                'en' => 'Phone Number Name'
            ],

            'Phone Number' => [
                'tr' => 'Telefon Numarası',
                'en' => 'Phone Number'
            ],

            'E-mail Address Name' => [
                'tr' => 'E-Mail Adres Adı',
                'en' => 'E-mail Address Name'
            ],

            'E-mail Address' => [
                'tr' => 'E-Mail Adresi',
                'en' => 'E-mail Address'
            ],

            'Price without VAT' => [
                'tr' => "KDV'siz Fiyat",
                'en' => 'Price without VAT'
            ],

            'VAT included' => [
                'tr' => "KDV Dahil",
                'en' => 'VAT included'
            ],

            'Cargo Price' => [
                'tr' => "Kargo Ücreti",
                'en' => 'Cargo Price'
            ],
            'Profile updated successfully' => [
                'tr' => 'Profil başarılı bir şekilde güncellendi',
                'en' => 'Profile updated successfully',
            ],

            'Current Password is Wrong' => [
                'tr' => 'Mevcut Şifre yanlış',
                'en' => 'Current Password is Wrong',
            ],

            'Password updated successfully' => [
                'tr' => 'Şifre başarılı bir şekilde güncellendi',
                'en' => 'Password updated successfully',
            ],

            'Image changed successfully' => [
                'tr' => 'Resim Başarılı bir şekilde güncellendi',
                'en' => 'Image changed successfully',
            ],
            'Order Received' => [
                'tr' => 'Sipariş Alındı',
                'en' => 'Order Received'
            ],

            'Getting ready' => [
                'tr' => 'Hazırlanıyor',
                'en' => 'Getting ready'
            ],

            'On hold' => [
                'tr' => 'Beklemede',
                'en' => 'On hold'
            ],

            'Shipped' => [
                'tr' => 'Kargoya Verildi',
                'en' => 'Shipped'
            ],

            'Delivered' => [
                'tr' => 'Teslim Edildi',
                'en' => 'Delivered'
            ],
            'Cancelled' => [
                'tr' => 'İptal Edildi',
                'en' => 'Cancelled'
            ],
            'Awaiting payment' => [
                'tr' => 'Ödeme Bekleniyor',
                'en' => 'Awaiting payment'
            ],
            'Awaiting Approval' => [
                'tr' => 'Onay Bekleniyor',
                'en' => 'Awaiting Approval'
            ],
            'Status' => [
                'tr' => 'Durum',
                'en' => 'Status'
            ],
            'Order Code' => [
                'tr' => 'Sipariş Kodu',
                'en' => 'Order Code'
            ],
            'Suppliers' => [
                'tr' => 'Tedarikçiler',
                'en' => 'Suppliers'
            ],

            'Show On Footer' => [
                'tr' => "Footer(Alt kısım)'da göster",
                'en' => 'Show On Footer'
            ],

            'Row' => [
                'tr' => "Satır",
                'en' => 'Row'
            ],

            'Column' => [
                'tr' => "Sütun",
                'en' => 'Column'
            ],

            'Modules' => [
                'tr' => "Modüller",
                'en' => 'Modules'
            ],

            'Show About Section' => [
                'tr' => "Hakkımızda Kısmını Göster",
                'en' => 'Show About Section'
            ],

            'Show Page Section' => [
                'tr' => "Sayfa Kısmını Göster",
                'en' => 'Show Page Section'
            ],

            'Show Proccess Section' => [
                'tr' => "Süreçler Kısmını Göster",
                'en' => 'Show Proccess Section'
            ],

            'Show Services Section' => [
                'tr' => "Servisler Kısmını Göster",
                'en' => 'Show Services Section'
            ],

            'Show Suppliers Section' => [
                'tr' => "Tedarikçiler Kısmını Göster",
                'en' => 'Show Suppliers Section'
            ],

            'Show Contact Section' => [
                'tr' => "İletişim Kısmını Göster",
                'en' => 'Show Contact Section'
            ],

            'Menu Settings' => [
                'tr' => "Menü Ayarları",
                'en' => 'Menu Settings'
            ],

            'Header Settings' => [
                'tr' => "Header Ayarları",
                'en' => 'Header Settings'
            ],

            'Footer Settings' => [
                'tr' => "Footer Ayarları",
                'en' => 'Footer Settings'
            ],

            'Select Top Menu' => [
                'tr' => "Üst Menü Seç",
                'en' => 'Select Top Menu'
            ],

            'Top Menu' => [
                'tr' => "Üst Menü",
                'en' => 'Top Menu'
            ],

            'Menu Row' => [
                'tr' => "Menü Sıra",
                'en' => 'Menu Row'
            ],

            'Menu Column' => [
                'tr' => "Menü Kolon",
                'en' => 'Menu Column'
            ],

            'URL' => [
                'tr' => "URL",
                'en' => 'URL'
            ],

            'Enter URL' => [
                'tr' => "URL Giriniz",
                'en' => 'Enter URL'
            ],

            'No URL' => [
                'tr' => "URL Yok",
                'en' => 'No URL'
            ],

            'A specific Page' => [
                'tr' => "Spesifik Bir Sayfa",
                'en' => 'A specific Page'
            ],

            'A specific Blog' => [
                'tr' => "Spesifik Bir Blog",
                'en' => 'A specific Blog'
            ],

            'A specific Supplier' => [
                'tr' => "Spesifik Bir Tedarikçi",
                'en' => 'A specific Supplier'
            ],

            'Manuel Input' => [
                'tr' => "Manuel (Elle) Giriş",
                'en' => 'Manuel Input'
            ],

            'Blogs' => [
                'tr' => "Bloglar",
                'en' => 'Blogs'
            ],

            'Row or column cannot be negative' => [
                'tr' => "Satır yada kolon negatif olamaz",
                'en' => 'Row or column cannot be negative'
            ],

            'The maximum number of columns can be 4' => [
                'tr' => "Kolon maksimum 4 olabilir",
                'en' => 'The maximum number of columns can be 4'
            ],

            'URL to go to on the Home Page (If empty, it goes to its own page) (Show on Home Page button must be active)' => [
                'tr' => "Ana Sayfada gideceği url (Eğer boş olursa kendi sayfasına gider) (Anasayfada göster butonu aktif olmalı)",
                'en' => 'URL to go to on the Home Page (If empty, it goes to its own page) (Show on Home Page button must be active)'
            ],

            'Show title on its own page' => [
                'tr' => "Kendi sayfasında başlık gözüksün",
                'en' => 'Show title on its own page'
            ],

            'Show date on its own page' => [
                'tr' => "Kendi sayfasında tarih gözüksün",
                'en' => 'Show date on its own page'
            ],

            'Open in different page' => [
                'tr' => "Farklı sayfada aç",
                'en' => 'Open in different page'
            ],

            'Show Whatsapp Section' => [
                'tr' => "Whatsapp Kısmını Göster",
                'en' => 'Show Whatsapp Section'
            ],

            'WhatsApp' => [
                'tr' => "WhatsApp",
                'en' => 'WhatsApp'
            ],

            'Enter Phone Number' => [
                'tr' => 'Telefon Numarası Giriniz',
                'en' => 'Enter Phone Number'
            ],

            'Reach us on WhatsApp!' => [
                'tr' => "Bize WhatsApp'tan ulaşın!",
                'en' => 'Reach us on WhatsApp!'
            ],

            'Please enter the country code without the + sign. And do not leave any spaces. For example: 905555555555' => [
                'tr' => "Lütfen + işareti olmadan ülke kodu ile birlikte giriniz. Ve boşluk bırakmayınız. Örneğin: 905555555555",
                'en' => 'Please enter the country code without the + sign. And do not leave any spaces. For example: 905555555555'
            ],

            'Gallery' => [
                'tr' => "Galeri",
                'en' => 'Gallery'
            ],

            'Gallery Create / Edit' => [
                'tr' => "Galleri Oluştur / Güncelle",
                'en' => 'Gallery Create / Edit'
            ],

            'VAT' => [
                'tr' => "KDV",
                'en' => 'VAT'
            ],

            'Gallery Descriptions'=>[
                'tr' => "Galeri Açıklamaları",
                'en' => 'Gallery Descriptions'
            ]


        ];

        // Ortak alanlar
        $commonValues = [
            'type' => 0,
        ];

        // Final verileri
        $finalData = [];

        // Her bir metin (key) ve dillerdeki karşılıkları döngü ile oluştur
        foreach ($adminTexts as $key => $languages) {
            foreach ($languages as $lang => $value) {
                $finalData[] = array_merge($commonValues, [
                    'key' => $key,
                    'language' => $lang,
                    'value' => $value
                ]);
            }
        }

        DB::table('translations')->insert($finalData);
    }
}
