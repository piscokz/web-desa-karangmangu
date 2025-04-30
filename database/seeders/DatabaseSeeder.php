<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('hamlets')->insert([
            [
                'nama_dusun' => 'Lingga Kamuning',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dusun' => 'Kramat Jaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dusun' => 'Lingga Harapan I',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dusun' => 'Lingga Harapan II',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dusun' => 'Lingga Harapan III',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Ambil ID dusun dari tabel hamlets
        $dusun = DB::table('hamlets')->pluck('id', 'nama_dusun');

        DB::table('rws')->insert([
            [
                'nomor_rw' => '01',
                'id_dusun' => $dusun['Lingga Kamuning'] ?? 1, // fallback ke id 1 kalau nggak ketemu
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_rw' => '02',
                'id_dusun' => $dusun['Kramat Jaya'] ?? 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_rw' => '03',
                'id_dusun' => $dusun['Lingga Harapan I'] ?? 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_rw' => '04',
                'id_dusun' => $dusun['Lingga Harapan II'] ?? 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nomor_rw' => '05',
                'id_dusun' => $dusun['Lingga Harapan III'] ?? 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Ambil ID RW dari DB, biar bisa mapping berdasarkan nomor RW
        $rwList = DB::table('rws')->pluck('id', 'nomor_rw');

        DB::table('rts')->insert([
            // RW 01
            ['nomor_rt' => '01', 'id_rw' => $rwList['01'] ?? 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '02', 'id_rw' => $rwList['01'] ?? 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '03', 'id_rw' => $rwList['01'] ?? 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // RW 02
            ['nomor_rt' => '04', 'id_rw' => $rwList['02'] ?? 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '05', 'id_rw' => $rwList['02'] ?? 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '06', 'id_rw' => $rwList['02'] ?? 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // RW 03
            ['nomor_rt' => '07', 'id_rw' => $rwList['03'] ?? 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '08', 'id_rw' => $rwList['03'] ?? 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '09', 'id_rw' => $rwList['03'] ?? 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // RW 04
            ['nomor_rt' => '10', 'id_rw' => $rwList['04'] ?? 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '11', 'id_rw' => $rwList['04'] ?? 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '12', 'id_rw' => $rwList['04'] ?? 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // RW 05
            ['nomor_rt' => '13', 'id_rw' => $rwList['05'] ?? 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '14', 'id_rw' => $rwList['05'] ?? 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '15', 'id_rw' => $rwList['05'] ?? 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => '16', 'id_rw' => $rwList['05'] ?? 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        DB::table('family_cards')->insert([
            [
                'no_kk' => '3201010101010001',
                'id_rt' => 1,
                'id_rw' => 1,
                'id_dusun' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_kk' => '3201010101010002',
                'id_rt' => 2,
                'id_rw' => 1,
                'id_dusun' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_kk' => '3201010101010003',
                'id_rt' => 4,
                'id_rw' => 2,
                'id_dusun' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('residents')->insert([
            [
                'nik' => '3201010101010001',
                'nama_lengkap' => 'Ahmad Saputra',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1990-01-15',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan' => 'Petani',
                'pendidikan' => 'SMA',
                'gol_darah' => 'O',
                'shdk' => 'Kepala Keluarga',
                'id_kk' => 1,
                'no_telp' => '081234567891',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => '3201010101010002',
                'nama_lengkap' => 'Siti Aminah',
                'tempat_lahir' => 'Cirebon',
                'tanggal_lahir' => '1993-07-10',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan' => 'Ibu Rumah Tangga',
                'pendidikan' => 'SMA',
                'gol_darah' => 'A',
                'shdk' => 'Istri',
                'id_kk' => 1,
                'no_telp' => '081234567892',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => '3201010101010003',
                'nama_lengkap' => 'Rizki Saputra',
                'tempat_lahir' => 'Kuningan',
                'tanggal_lahir' => '2015-03-21',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'pekerjaan' => 'Pelajar',
                'pendidikan' => 'SD',
                'gol_darah' => 'B',
                'shdk' => 'Anak',
                'id_kk' => 1,
                'no_telp' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
