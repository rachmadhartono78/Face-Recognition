<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'nama_karyawan' => 'rachmad hartono',
            'jabatan' => 'Manager',
            'email' => 'johndoe@example.com',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'nomor_hp' => '08123456789',
        ]);
    }
}
