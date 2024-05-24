<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Init extends Seeder
{
    public function run()
    {
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
    }
}
