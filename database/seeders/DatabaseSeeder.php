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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'fariyd001@gmail.com',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Seed hamlets
        DB::table('hamlets')->insert([
            ['nama_dusun' => 'Hamlet 1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_dusun' => 'Hamlet 2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_dusun' => 'Hamlet 3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_dusun' => 'Hamlet 4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_dusun' => 'Hamlet 5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Seed RWs
        DB::table('rws')->insert([
            ['nomor_rw' => 'RW 01', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_dusun' => 1],
            ['nomor_rw' => 'RW 02', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_dusun' => 2],
            ['nomor_rw' => 'RW 03', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_dusun' => 3],
            ['nomor_rw' => 'RW 04', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_dusun' => 4],
            ['nomor_rw' => 'RW 05', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_dusun' => 5],
        ]);

        // Seed RTs
        DB::table('rts')->insert([
            ['nomor_rt' => 'RT 01', 'id_rw' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
            ['nomor_rt' => 'RT 02', 'id_rw' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => 'RT 03', 'id_rw' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nomor_rt' => 'RT 04', 'id_rw' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Seed family cards
        DB::table('family_cards')->insert([
            ['no_kk' => '1234567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 1, 'id_rw' => 1, 'id_dusun' => 1, 'alamat' => 'Jl. Raya No. 1'],
            ['no_kk' => '2345678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 1, 'id_rw' => 1, 'id_dusun' => 1, 'alamat' => 'Jl. Raya No. 2'],
            ['no_kk' => '3456789012', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 2, 'id_rw' => 1, 'id_dusun' => 1, 'alamat' => 'Jl. Raya No. 3'],
            ['no_kk' => '4567890123', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 2, 'id_rw' => 1, 'id_dusun' => 1, 'alamat' => 'Jl. Raya No. 4'],
        ]);

        // Seed residents
        DB::table('residents')->insert([
            ['nama_lengkap' => 'Satoshi Nakamoto', 'id_kk' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '1234567890123456', 'tempat_lahir' => 'Bitcoin', 'tanggal_lahir' => '1990-01-01', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Menikah', 'pekerjaan' => 'Coin Creator', 'pendidikan' => 'S3', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '2573253', 'disabilitas' => 'Tidak Ada', 'organisasi' => 'Karang Taruna', 'nama_ayah' => 'Ayah 1', 'nama_ibu' => 'Ibu 1'],
            ['nama_lengkap' => 'Mutiara Permata', 'id_kk' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '2345678901234567', 'tempat_lahir' => 'City B', 'tanggal_lahir' => '1992-02-02', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Kristen', 'status_perkawinan' => 'Menikah', 'pekerjaan' => 'Ibu Rumah Tangga', 'pendidikan' => 'S1', 'gol_darah' => 'A', 'shdk' => 'Istri', 'no_telp' => '1234567890', 'disabilitas' => 'Tidak Ada', 'organisasi' => 'Bumdes', 'nama_ayah' => 'Ayah 2', 'nama_ibu' => 'Ibu 2'],
        ]);

        DB::table('village_contacts')->insert([
            'no_telepon' => '',
            'email' => '',
            'instagram' => '',
            'youtube' => '',
            'facebook' => '',
            'created_at' => Carbon::now(),
        ]);
    }
}
