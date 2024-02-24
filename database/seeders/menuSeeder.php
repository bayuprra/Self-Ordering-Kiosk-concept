<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class menuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama'              => "Stuffed Phoenix Wingettes",
                'kategori_id'       => 1,
                'available'         => true,
                'Harga'             => 50000,
                'deskripsi'         => "Five spices marinated ground chicken, lap cheong, sweet & sour plum sauce",
                'gambar'            => "stuffed.png"
            ],
            [
                'nama'              => "Nashville Fried Chicken",
                'kategori_id'       => 1,
                'available'         => true,
                'Harga'             => 65000,
                'deskripsi'         => "Chicken drummetes, special hot sauce, spiced pickled cucumber",
                'gambar'            => "Nashville.png"
            ],
            [
                'nama'              => "Garlic Crispy Chicken",
                'kategori_id'       => 1,
                'available'         => true,
                'Harga'             => 35000,
                'deskripsi'         => "Turmeric and coriander marinated chicken karaage, fried garlic, lemon",
                'gambar'            => "Garlic.png"
            ],
            [
                'nama'              => "Boiled edamame",
                'kategori_id'       => 1,
                'available'         => true,
                'Harga'             => 75000,
                'deskripsi'         => "Garlic & chili oil, togarashi, furikake",
                'gambar'            => "Smoked.png"
            ],
            [
                'nama'              => "Calamari Fritos",
                'kategori_id'       => 1,
                'available'         => true,
                'Harga'             => 100000,
                'deskripsi'         => "Semolina batter coated, black squid ink garlic aioli, lemon",
                'gambar'            => "Calamari.png"
            ],

            [
                'nama'              => "FOREFATHER NEGRONI",
                'kategori_id'       => 2,
                'available'         => true,
                'Harga'             => 500000,
                'deskripsi'         => "COCKTAIL INI BASIC DARI MILANO TORINO CLASSIC COCKTAIL DIMANA HISTORYNYA ADALAH MILANO TORINO ADALAH BAPAK DARI CALSSIC AMERICANO DAN NEGRONI, MILANO TORINO BERASAL DARI 1860.an OLEH JESUS GOMEZ HEAD BAR, TERBUAT DARI PUNT E MES DAN CAMPARI, DINAMAKAN MILANO TORINO KARENA CAMPARI ADALAH DARI MILAN (MILANO) DAN PUNT E MES DULUNYA BERASAL DARI TURIN (TORINO) DAN MENJADI POPULER DI TAHUN 1870.an, COCKTAIL INI KEMUDIAN DI TWIST DENGAN BAHAN DASAR AGAVE SYRUP DAN PINEAPPLE VINEGAR DENGAN SENTUHAN AROMA SMOKY DARI WHITE RICE YANG DI BAKAR DENGAN SMOKE TOP. PERSEMBAHAN TWIST COCKTAIL INI DINAMAKAN FORE FATHER NEGRONI KARENA COCKTAIL INI ADALAH BASIC DARI AMERICANO DAN NEGRONI.",
                'gambar'            => "FOREFATHER.png"
            ],
            [
                'nama'              => "ARCANE TROVE",
                'kategori_id'       => 2,
                'available'         => true,
                'Harga'             => 650000,
                'deskripsi'         => "COCKTAIL BASIC DARI MILK PUNCH STYLE , MILK PUNCH SANGAT POPULER DI NEW ORLEANS PADA ABAD 18.an, INI TERMASUK SUSU DAN SPIRIT VERSI PERTAMA DAN ENGLISH MILK PUNCH/CLARIFIED MILK PUNCH VERSI YANG KEDUA, YAITU SUSU DI PANASKAN SEBELUM DICAMPUR DENGAN COCKTAIL CAMPURAN LAINNYA, INI AKAN MENGENTALKAN SUSU KEMUDIAN DISARING MENGGUNAKAN CHEESE CLOTH UNTUK MEMFILTER DAN MENGHILANGKAN SEDIMEN. PROSES INI MENGHILANGKAN KERUH DAN MEMBUAT WARNA LEBIH JERNIH DAN JELAS. DAN UNTUK COCKTAIL INI DI TWIST TERINSPIRASI DARI KARAKTER RASA  COFFEE LATTE, DIMANA SPIRIT ATAU COCKTAIL LIQUID DI CLARIFIED DENGAN CARA MILK WASHED CLARIFIED MENGGUNAKAN BANTUAN MILK PROTEIN DAN CITRUS UNTUK MEMECAH DAN PENGGUMPALAN SEDIMEN KEMUDIAN DI FILTER MENGGUNAKAN V60 PAPER FILTER. DENGAN KONSEP THREASURE DI COCKTAIL INI , MENGGAMBARKAN LAYAKNYA HARTA KARUN BERBENTUK LIQUID COCKTAIL DIMANA IDENTIK DENGAN EMAS DAN DI PERKAYA DENGAN KOMPLEKSITAS RASA. ",
                'gambar'            => "ARCANE.png"
            ],
            [
                'nama'              => "RISE FROM THE SEEDS",
                'kategori_id'       => 2,
                'available'         => true,
                'Harga'             => 350000,
                'deskripsi'         => "COCKTAIL BASIC DARI WHISKEY SOUR CLASSIC COCKTAIL, HISTORY CLASSIC INI ADALAH PERTAMA KALI DI SEBUTKAN OLEH THE BARTENDERS GUIDE BY JERRY THOMAS PADA TAHUN 1862, NAMUN KEMUNGKINAN SEBELUM ITU PARA PELAUT SUDAH MEMINUMNYA, PARA PELAUT SANGAT SULIT MENDAPATKAN AIR BERSIH DAN SEGAR DALAM PERJALANAN BERLAYAR , MAKA WHISKEY DAN RUM DAN MINUMAN BERALKOHOL LAINNYA SANGAT POPULER DIKALANGAN PARA PELAUT, BANYAK PELAUT ITU TERSERANG PENYAKIT KUDIS DIKARENAKAN KEKURANGAN VITAMIN C , JADI PARA PELAUTMEMBAWA LEMON , LIMAU DAN JERUK DALAM JUMLAH BESAR. JADI PARA PELAUT ITU MEMBAWA BEKAL WHISKEY DAN ASAM UNTUK BERLAYAR YANG KEMUDIAN COCOK UNTUK MEMUASKAN DAHAGA PARA PELAUT. DAN INI KEMUDIAN DI TWIST DENGAN BAHAN DASAR YANG IDENTIK DENGAN JAPANESE, JADI WHISKEY SOUR DENGAN SENTUHAN BAHAN DASAR KHAS JAPAN, KAYA AKAN RASA DAN SANGAT KOMPLEKS, MEMPUNYAI KARAKTER YANG KHAS DAN UNIK PRESENTASI COCKTAILNYA.",
                'gambar'            => "Garlic.png"
            ],
            [
                'nama'              => "TOWER OF VERSAILLES",
                'kategori_id'       => 2,
                'available'         => true,
                'Harga'             => 750000,
                'deskripsi'         => "COCKTAIL INI BASIC DARI MARTINI STYLE , SEDIKIT HISTORY DARI MARTINI ADALAH DICATAT DAN DIKENAL DENGAN NAMA MARTINEZ , YANG KEMUDIAN ADA BARTENDER ITALIA DI BAR KNICKERBOCKER YANG TERKENAL, MENGGANTI BAHANNYA DENGAN GIN KERING DAN VERMOUTH KERING , DIA MENYARANKAN KEPADA TUAN ROCKEFELLER NAMA BARU UNTUK MINUMAN TERSEBUT : MARTINI , YANG MERUPAKAN NAMA BARTENDER DAN NAMA BRAND VERMOUTH YANG DIGUNAKAN DALAM MINUMAN TERSEBUT. COCKTAIL INI DI TWIST DENGAN MENGGUNAKAN BAHAN DASAR FLORAL DAN FRUITY TASTE, KOMBINASI LUAR BIASA ANTARA RASA,AROMA DAN FAKTOR WOW DARI ASAP DRY ICE DI ALAT COLD DRIPPERNYA. COCKTAIL INI SERVE DI TABLE TAMU DAN MEMERLUKAN WAKTU MALKSIMAL 5 MENIT UNTUK MENUNGGU HASIL DRIPNYA.",
                'gambar'            => "TOWER.png"
            ],
            [
                'nama'              => "MALABAR SPRITZ",
                'kategori_id'       => 2,
                'available'         => true,
                'Harga'             => 1000000,
                'deskripsi'         => "COCKTAIL BASIC DARI AMAERICANO CLASSIC COCKTAIL DENGAN KONSEP SPRITZ STYLE, AMERICANO ADALAH COCKTAIL DENGAN CAMPARI, ROSSO VERMOUTH DAN SODA , SEDANGKAN SPRITZ ADALAH BAHASA JERMAN UNTUK PERCIKAN, DIMANA ORANG AUSTRIA KETIKA DI ITALIA INGIN MENGENCERKAN ANGGUR DENGAN PERCIKAN SODA (BAHASA JERANNYA ADALAH SPRITZ) DAN COCKTAIL INI DI TWIST DENGAN BAHAN SPICES DAN FLORAL, TERMASUK CATEGORY COCKTAIL BITTERSWEET DAN KAYA AKAN CO2 YANG SANGAT MEMBANTU MENGELUARKAN BANYAK KARAKTER RASA YANG MENYEGARKAN.",
                'gambar'            => "MALABAR.png"
            ],
            [
                'nama'              => "Aqua",
                'kategori_id'       => 3,
                'available'         => true,
                'Harga'             => 20000,
                'deskripsi'         => null,
                'gambar'            => "prev.png"
            ]
        ];

        foreach ($data as $item) {
            Menu::create($item);
        }
    }
}
