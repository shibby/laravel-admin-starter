<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('slug', 50)->unique()->index();
        });

        \DB::statement("
INSERT INTO `cities` (`id`, `name`, `slug`) VALUES
(1,	'Adana',	'adana'),
(2,	'Adıyaman',	'adiyaman'),
(3,	'Afyonkarahisar',	'afyonkarahisar'),
(4,	'Ağrı',	'agri'),
(5,	'Aksaray',	'aksaray'),
(6,	'Amasya',	'amasya'),
(7,	'Ankara',	'ankara'),
(8,	'Antalya',	'antalya'),
(9,	'Ardahan',	'ardahan'),
(10,	'Artvin',	'artvin'),
(11,	'Aydın',	'aydin'),
(12,	'Balıkesir',	'balikesir'),
(13,	'Bartın',	'bartin'),
(14,	'Batman',	'batman'),
(15,	'Bayburt',	'bayburt'),
(16,	'Bilecik',	'bilecik'),
(17,	'Bingöl',	'bingol'),
(18,	'Bitlis',	'bitlis'),
(19,	'Bolu',	'bolu'),
(20,	'Burdur',	'burdur'),
(21,	'Bursa',	'bursa'),
(22,	'Çanakkale',	'canakkale'),
(23,	'Çankırı',	'cankiri'),
(24,	'Çorum',	'corum'),
(25,	'Denizli',	'denizli'),
(26,	'Diyarbakır',	'diyarbakir'),
(27,	'Düzce',	'duzce'),
(28,	'Edirne',	'edirne'),
(29,	'Elazığ',	'elazig'),
(30,	'Erzincan',	'erzincan'),
(31,	'Erzurum',	'erzurum'),
(32,	'Eskişehir',	'eskisehir'),
(33,	'Gaziantep',	'gaziantep'),
(34,	'Giresun',	'giresun'),
(35,	'Gümüşhane',	'gumushane'),
(36,	'Hakkari',	'hakkari'),
(37,	'Hatay',	'hatay'),
(38,	'Iğdır',	'igdir'),
(39,	'Isparta',	'isparta'),
(40,	'İstanbul',	'istanbul'),
(41,	'İzmir',	'izmir'),
(42,	'Kahramanmaraş',	'kahramanmaras'),
(43,	'Karabük',	'karabuk'),
(44,	'Karaman',	'karaman'),
(45,	'Kars',	'kars'),
(46,	'Kastamonu',	'kastamonu'),
(47,	'Kayseri',	'kayseri'),
(48,	'Kırıkkale',	'kirikkale'),
(49,	'Kırklareli',	'kirklareli'),
(50,	'Kırşehir',	'kirsehir'),
(51,	'Kilis',	'kilis'),
(52,	'Kocaeli',	'kocaeli'),
(53,	'Konya',	'konya'),
(54,	'Kütahya',	'kutahya'),
(55,	'Malatya',	'malatya'),
(56,	'Manisa',	'manisa'),
(57,	'Mardin',	'mardin'),
(58,	'Mersin',	'mersin'),
(59,	'Muğla',	'mugla'),
(60,	'Muş',	'mus'),
(61,	'Nevşehir',	'nevsehir'),
(62,	'Niğde',	'nigde'),
(63,	'Ordu',	'ordu'),
(64,	'Osmaniye',	'osmaniye'),
(65,	'Rize',	'rize'),
(66,	'Sakarya',	'sakarya'),
(67,	'Samsun',	'samsun'),
(68,	'Siirt',	'siirt'),
(69,	'Sinop',	'sinop'),
(70,	'Sivas',	'sivas'),
(71,	'Şanlıurfa',	'sanliurfa'),
(72,	'Şırnak',	'sirnak'),
(73,	'Tekirdağ',	'tekirdag'),
(74,	'Tokat',	'tokat'),
(75,	'Trabzon',	'trabzon'),
(76,	'Tunceli',	'tunceli'),
(77,	'Uşak',	'usak'),
(78,	'Van',	'van'),
(79,	'Yalova',	'yalova'),
(80,	'Yozgat',	'yozgat'),
(81,	'Zonguldak',	'zonguldak');
"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
