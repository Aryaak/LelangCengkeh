<?php

namespace Database\Seeders;

use App\Models\Auction;
use Illuminate\Database\Seeder;

class AuctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auction::create([
            'user_id' => 1,
            'photo' => 'auction/default/1.webp',
            'title' => 'Cengkeh Zanzibar',
            'description' => 'Karakteristik cengkeh Zanzibar dengan bunga berwarna kemerahan, pucuk daun berwarna merah muda, tangkai daun hingga cabang berwarna hijau tua, dan permukaan daun yang mengkilap.',
            'start_at' => '2022-03-30 21:31:35',
            'end_at' => '2022-04-20 01:11:30',
            'start_price' => '100000'
        ]);
        Auction::create([
            'user_id' => 1,
            'photo' => 'auction/default/2.webp',
            'title' => 'Cengkeh Sikotok',
            'description' => 'Karakteristik cengkeh Sikotok dengan bunga berwarna kuning, pucuk daun berwarna merah muda, tangkai daun hingga cabang berwarna merah dan daun tua berwarna hijau dengan permukaan daun yang mengkilap.',
            'start_at' => '2022-03-30 21:31:35',
            'end_at' => '2022-04-05 02:00:00',
            'start_price' => '150000'
        ]);
        Auction::create([
            'user_id' => 1,
            'photo' => 'auction/default/3.webp',
            'title' => 'Cengkeh Siputih',
            'description' => 'Karakteristiknya dengan bunga berwarna kuning berukuran besar, pucuk daun berwarna kuning hingga hijau muda. Tangkai dan tulang daun mudanya berwarna kuning kehijauan dan daun tuanya berwarna hijau. Daunnya lebih besar ketimbang jenis lain dan tidak mengkilap.',
            'start_at' => '2022-03-30 21:31:35',
            'end_at' => '2022-04-11 07:11:30',
            'start_price' => '200000'
        ]);
    }
}
