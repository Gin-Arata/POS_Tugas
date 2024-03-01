<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => '1',
                'user_id' => '3',
                'pembeli' => 'Agus',
                'penjualan_kode' => 'PJ-2022001',
                'penjualan_tanggal' => '2022-02-01',
            ],
            [
                'penjualan_id' => '2',
                'user_id' => '3',
                'pembeli' => 'Asep',
                'penjualan_kode' => 'PJ-2022002',
                'penjualan_tanggal' => '2022-02-02',
            ],
            [
                'penjualan_id' => '3',
                'user_id' => '3',
                'pembeli' => 'Yuni',
                'penjualan_kode' => 'PJ-2022003',
                'penjualan_tanggal' => '2022-02-03',
            ],
            [
                'penjualan_id' => '4',
                'user_id' => '3',
                'pembeli' => 'Dwi',
                'penjualan_kode' => 'PJ-2022004',
                'penjualan_tanggal' => '2022-02-04',
            ],
            [
                'penjualan_id' => '5',
                'user_id' => '3',
                'pembeli' => 'Bagus',
                'penjualan_kode' => 'PJ-2022005',
                'penjualan_tanggal' => '2022-02-05',
            ],
            [
                'penjualan_id' => '6',
                'user_id' => '3',
                'pembeli' => 'Agung',
                'penjualan_kode' => 'PJ-2022006',
                'penjualan_tanggal' => '2022-02-06',
            ],
            [
                'penjualan_id' => '7',
                'user_id' => '3',
                'pembeli' => 'Soeharto',
                'penjualan_kode' => 'PJ-2022007',
                'penjualan_tanggal' => '2022-02-07',
            ],
            [
                'penjualan_id' => '8',
                'user_id' => '3',
                'pembeli' => 'Jokowi',
                'penjualan_kode' => 'PJ-2022008',
                'penjualan_tanggal' => '2022-02-08',
            ],
            [
                'penjualan_id' => '9',
                'user_id' => '3',
                'pembeli' => 'Bambang',
                'penjualan_kode' => 'PJ-2022009',
                'penjualan_tanggal' => '2022-02-09',
            ],
            [
                'penjualan_id' => '10',
                'user_id' => '3',
                'pembeli' => 'Megawati',
                'penjualan_kode' => 'PJ-2022010',
                'penjualan_tanggal' => '2022-02-10',
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
