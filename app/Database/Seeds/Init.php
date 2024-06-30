<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Init extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kode = ['K1', 'K2', 'K3', 'K4', 'K5'];
        $nama = ['Kriteria 1', 'Kriteria 2', 'Kriteria 3', 'Kriteria 4', 'Kriteria 5'];
        $bobot = ['1', '2', '3', '4', '5'];


        for ($i = 0; $i < count($nama); $i++) {
            $data = [
                'kode' => $kode[$i],
                'nama' => $nama[$i],
                'bobot' => $bobot[$i],
            ];

            $this->db->table('tb_kriteria')->insert($data);
        }

        // sub kriteria
        // use looping
        $sub_kriteria = [
            ['1', 'Sub Kriteria 1', '1'],
            ['1', 'Sub Kriteria 2', '2'],
            ['1', 'Sub Kriteria 3', '3'],
            ['1', 'Sub Kriteria 4', '4'],
            ['1', 'Sub Kriteria 5', '5'],
            ['2', 'Sub Kriteria 1', '1'],
            ['2', 'Sub Kriteria 2', '2'],
            ['2', 'Sub Kriteria 3', '3'],
            ['2', 'Sub Kriteria 4', '4'],
            ['2', 'Sub Kriteria 5', '5'],
            ['3', 'Sub Kriteria 1', '1'],
            ['3', 'Sub Kriteria 2', '2'],
            ['3', 'Sub Kriteria 3', '3'],
            ['3', 'Sub Kriteria 4', '4'],
            ['3', 'Sub Kriteria 5', '5'],
            ['4', 'Sub Kriteria 1', '1'],
            ['4', 'Sub Kriteria 2', '2'],
            ['4', 'Sub Kriteria 3', '3'],
            ['4', 'Sub Kriteria 4', '4'],
            ['4', 'Sub Kriteria 5', '5'],
            ['5', 'Sub Kriteria 1', '1'],
            ['5', 'Sub Kriteria 2', '2'],
            ['5', 'Sub Kriteria 3', '3'],
            ['5', 'Sub Kriteria 4', '4'],
            ['5', 'Sub Kriteria 5', '5'],
        ];

        foreach ($sub_kriteria as $row) {
            $percentageString = ['0-20', '21-40', '41-60', '61-80', '81-100'];
            $data = [
                'kriteria_id' => $row[0],
                'nama' => $row[1],
                'bobot' => $row[2],
                'percentage' => $percentageString[array_rand($percentageString)],
            ];

            $this->db->table('tb_sub_kriteria')->insert($data);
        }


        // USE FAKER

        for ($i = 0; $i < 10; $i++) {
            $data = [
                'nama' => $faker->name,
                'nip' => $faker->nik,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date,
                'bidang_tugas' => $faker->jobTitle,
            ];

            $this->db->table('tb_alternatif')->insert($data);
        }
    }
}
