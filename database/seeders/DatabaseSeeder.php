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
            ['no_kk' => '5678901234', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 3, 'id_rw' => 2, 'id_dusun' => 2, 'alamat' => 'Jl. Raya No. 5'],
            ['no_kk' => '6789012345', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 3, 'id_rw' => 2, 'id_dusun' => 2, 'alamat' => 'Jl. Raya No. 6'],
            ['no_kk' => '7890123456', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 4, 'id_rw' => 3, 'id_dusun' => 3, 'alamat' => 'Jl. Raya No. 7'],
            ['no_kk' => '8901234567', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 4, 'id_rw' => 3, 'id_dusun' => 3, 'alamat' => 'Jl. Raya No. 8'],
            ['no_kk' => '9012345678', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 1, 'id_rw' => 4, 'id_dusun' => 4, 'alamat' => 'Jl. Raya No. 9'],
            ['no_kk' => '0123456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'id_rt' => 1, 'id_rw' => 4, 'id_dusun' => 4, 'alamat' => 'Jl. Raya No. 10'],
        ]);

        // Seed residents
        DB::table('residents')->insert([
            ['nama_lengkap' => 'Satoshi Nakamoto', 'id_kk' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '1234567890123456', 'tempat_lahir' => 'Bitcoin', 'tanggal_lahir' => '1990-01-01', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Coin Creator', 'pendidikan' => 'DOKTOR (S3)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '2573253', 'disabilitas' => 'Tidak Ada', 'nama_ayah' => 'Ayah 1', 'nama_ibu' => 'Ibu 1'],
            ['nama_lengkap' => 'Mutiara Permata', 'id_kk' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '2345678901234567', 'tempat_lahir' => 'City B', 'tanggal_lahir' => '1992-02-02', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Kristen', 'status_perkawinan' => 'Kawin', 'pekerjaan' => 'Ibu Rumah Tangga', 'pendidikan' => 'DOKTOR (S3)', 'gol_darah' => 'A', 'shdk' => 'Istri', 'no_telp' => '1234567890', 'disabilitas' => 'Tidak Ada', 'nama_ayah' => 'Ayah 2', 'nama_ibu' => 'Ibu 2'],
            ['nama_lengkap' => 'John Doe', 'id_kk' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '3456789012345678', 'tempat_lahir' => 'City C', 'tanggal_lahir' => '1995-03-03', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Hindu', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'MAGISTER (S2)', 'gol_darah' => 'B', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Ada', 'nama_ayah' => '', 'nama_ibu' => '',],
            ['nama_lengkap' => 'Jane Smith', 'id_kk' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '4567890123456789', 'tempat_lahir' => 'City D', 'tanggal_lahir' => '1998-04-04', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Buddha', 'status_perkawinan' => 'Kawin', 'pekerjaan' => 'Designer', 'pendidikan' => 'S1', 'gol_darah' => 'AB', 'shdk' => 'Istri', 'no_telp' => '', 'disabilitas' => 'Tidak Ada', 'nama_ayah' => '', 'nama_ibu' => '',],
            ['nama_lengkap' => 'Alice Wonderland', 'id_kk' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '5678901234567890', 'tempat_lahir' => 'City E', 'tanggal_lahir' => '2000-05-05', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Bob Builder', 'id_kk' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '6789012345678901', 'tempat_lahir' => 'City F', 'tanggal_lahir' => '2002-06-06', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Kristen', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Charlie Brown', 'id_kk' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '7890123456789012', 'tempat_lahir' => 'City G', 'tanggal_lahir' => '2005-07-07', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Daisy Duck', 'id_kk' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '8901234567890123', 'tempat_lahir' => 'City H', 'tanggal_lahir' => '2007-08-08', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Kristen', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Eve Adams', 'id_kk' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '9012345678901234', 'tempat_lahir' => 'City I', 'tanggal_lahir' => '2010-09-09', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Frank Castle', 'id_kk' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '0123456789012345', 'tempat_lahir' => 'City J', 'tanggal_lahir' => '2012-10-10', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Kristen', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'George Washington', 'id_kk' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '1234567890123886', 'tempat_lahir' => 'City K', 'tanggal_lahir' => '2015-11-11', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Hannah Montana', 'id_kk' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '2345678901234568', 'tempat_lahir' => 'City L', 'tanggal_lahir' => '2017-12-12', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Kristen', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Ivy League', 'id_kk' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '3456789012345679', 'tempat_lahir' => 'City M', 'tanggal_lahir' => '2020-01-01', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Jack Daniels', 'id_kk' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '4567890123456780', 'tempat_lahir' => 'City N', 'tanggal_lahir' => '2022-02-02', 'jenis_kelamin' => 'Laki-laki', 'agama' => 'Kristen', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
            ['nama_lengkap' => 'Katy Perry', 'id_kk' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'nik' => '5678901234567891', 'tempat_lahir' => 'City O', 'tanggal_lahir' => '2024-03-03', 'jenis_kelamin' => 'Perempuan', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Software Engineer', 'pendidikan' => 'SARJANA (S1)', 'gol_darah' => 'O', 'shdk' => 'Kepala Keluarga', 'no_telp' => '', 'disabilitas' => 'Tidak Cacat', 'nama_ayah' => 'Budi', 'nama_ibu' => 'Siti',],
        ]);

        DB::table('village_contacts')->insert([
            'no_telepon' => '8123456789',
            'email' => '',
            'instagram' => 'https://www.instagram.com/pps_winduherang',
            'youtube' => '',
            'facebook' => '',
            'created_at' => Carbon::now(),
        ]);

        // Seed population deaths
        DB::table('population_deaths')->insert([
            [
                'penduduk_id' => 1,
                'tanggal_meninggal' => '2023-01-01',
                'penyebab' => 'dihack Bitcoin sama hacker',
                'keterangan' => 'Meninggal di rumah sakit karena serangan jantung akibat terlalu banyak memikirkan Bitcoin yang hilang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'penduduk_id' => 2,
                'tanggal_meninggal' => '2023-02-02',
                'penyebab' => 'Kecelakaan',
                'keterangan' => 'Meninggal di tempat kejadian',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('village_members')->insert([
            [
                'nama' => 'H.UJA AZIZI',
                'jabatan' => 'Kepala Desa',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1964-01-01',
                'alamat' => 'DUSUN PAHING DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'NANDA SUNANDA',
                'jabatan' => 'Sekretaris Desa',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1976-01-01',
                'alamat' => 'DUSUN WAGE DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'ERI NURFITRIANI',
                'jabatan' => 'Kaur Keuangan',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1995-01-01',
                'alamat' => 'DUSUN MANIS DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'UGI SUGIHARTO',
                'jabatan' => 'Kasi Kesejahteraan',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1979-01-01',
                'alamat' => 'DUSUN MANIS DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'IWAN GUNAWAN',
                'jabatan' => 'Kasi Pemerintahan',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1977-01-01',
                'alamat' => 'DUSUN WAGE DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'EFAN NUGRAHA',
                'jabatan' => 'Kaur TU dan Umum',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1993-01-01',
                'alamat' => 'DUSUN PAHING DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'MUHAMMAD SAHURI',
                'jabatan' => 'Kasi Pelayanan',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1976-01-01',
                'alamat' => 'DUSUN MANIS DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'FIRMANSYAH',
                'jabatan' => 'Kaur Perencanaan',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1988-01-01',
                'alamat' => 'DUSUN PUHUN DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'EDI SUHEDI',
                'jabatan' => 'KEPALA DUSUN PAHING',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1975-01-01',
                'alamat' => 'DUSUN PAHING DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'MAMAN SULAEMAN',
                'jabatan' => 'KEPALA DUSUN MANIS',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1979-01-01',
                'alamat' => 'DUSUN MANIS DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'PIPIN ALI HANAPIAH',
                'jabatan' => 'KEPALA DUSUN WAGE',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1973-01-01',
                'alamat' => 'DUSUN WAGE DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'MAMAN KADARISMAN',
                'jabatan' => 'KEPALA DUSUN PUHUN',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1973-01-01',
                'alamat' => 'DUSUN PUHUN DESA KARANGMANGU Kecamatan KRAMATMULYA KABUPATEN KUNINGAN',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
