<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\PenilaianModel;

class Perhitungan extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
    }

    public function index(): string
    {

        $this->data['title'] = "Perhitungan Topsis";
        $this->data['active'] = "perhitungan";

        if (PenilaianModel::countAll() == 0) {
            $this->data['message'] = "Data penilaian masih kosong. Silahkan isi data penilaian terlebih dahulu.";
            $this->data['is_empty'] = true;
        } else {
            $this->data['is_empty'] = false;

            $this->perhitungan();
        }

        return view('Panel/Page/Perhitungan/index', $this->data);
    }


    public function reset()
    {
        // Reset the penilaian
        PenilaianModel::truncate();

        return redirect()->to(route_to('perhitungan'));
    }


    public function perhitungan()
    {
        // Retrieve all necessary data
        $this->data['kriteria'] = KriteriaModel::all();
        $this->data['subkriteria'] = SubKriteriaModel::all()->keyBy('id'); // Key by sub_kriteria_id for easy access
        $this->data['alternatif'] = AlternatifModel::all();
        $this->data['penilaian'] = PenilaianModel::all();
        // Initialize the decision matrix
        $matriks_keputusan = [];

        // Loop through each penilaian to build the decision matrix
        foreach ($this->data['penilaian'] as $penilaian) {
            // Parse the JSON string to get sub-kriteria values
            $sub_kriteria_values = json_decode($penilaian->sub_kriteria_id, true);

            // Initialize an array to store the weights for the current alternatif
            $weights = [];

            // Loop through each sub-kriteria id to get the corresponding weight
            foreach ($sub_kriteria_values as $kriteria_id => $sub_kriteria_id) {
                if (isset($this->data['subkriteria'][$sub_kriteria_id])) {
                    $weights[$kriteria_id] = $this->data['subkriteria'][$sub_kriteria_id]->bobot;
                }
            }
            // Add the weights to the decision matrix
            $matriks_keputusan[$penilaian->alternatif_id] = $weights;
        }

        // bobot kriteria W
        $bobot_kriteria = [];
        foreach ($this->data['kriteria'] as $kriteria) {
            $bobot_kriteria[$kriteria->id] = $kriteria->bobot;
        }


        // Matrix normalization
        $matriks_normalisasi = [];
        foreach ($matriks_keputusan as $alternatif_id => $weights) {
            $matriks_normalisasi[$alternatif_id] = [];
            foreach ($weights as $kriteria_id => $weight) {
                $matriks_normalisasi[$alternatif_id][$kriteria_id] = $weight / sqrt(array_sum(array_column($matriks_keputusan, $kriteria_id)));
            }
        }

        // Matrix Y
        $matriks_y = [];
        foreach ($matriks_normalisasi as $alternatif_id => $weights) {
            $matriks_y[$alternatif_id] = [];
            foreach ($weights as $kriteria_id => $weight) {
                $matriks_y[$alternatif_id][$kriteria_id] = $weight * $bobot_kriteria[$kriteria_id];
            }
        }

        // solusi ideal positif dan negatif
        $solusi_ideal_positif = [];
        $solusi_ideal_negatif = [];
        foreach ($this->data['kriteria'] as $kriteria) {
            $solusi_ideal_positif[$kriteria->id] = max(array_column($matriks_y, $kriteria->id));
            $solusi_ideal_negatif[$kriteria->id] = min(array_column($matriks_y, $kriteria->id));
        }

        // jarak alternatif terhadap solusi ideal positif dan negatif
        $jarak_positif = [];
        $jarak_negatif = [];
        foreach ($matriks_y as $alternatif_id => $weights) {
            $jarak_positif[$alternatif_id] = 0;
            $jarak_negatif[$alternatif_id] = 0;
            foreach ($weights as $kriteria_id => $weight) {
                $jarak_positif[$alternatif_id] += pow($weight - $solusi_ideal_positif[$kriteria_id], 2);
                $jarak_negatif[$alternatif_id] += pow($weight - $solusi_ideal_negatif[$kriteria_id], 2);
            }
            $jarak_positif[$alternatif_id] = sqrt($jarak_positif[$alternatif_id]);
            $jarak_negatif[$alternatif_id] = sqrt($jarak_negatif[$alternatif_id]);
        }

        // kedekatan alternatif terhadap solusi ideal positif dan negatif
        $kedekatan = [];
        foreach ($jarak_negatif as $alternatif_id => $jarak) {
            $kedekatan[$alternatif_id] = $jarak_negatif[$alternatif_id] / ($jarak_negatif[$alternatif_id] + $jarak_positif[$alternatif_id]);
        }

        // Sort the alternatif based on the closeness coefficient
        arsort($kedekatan);
        // Set the data
        $this->data['matriks_keputusan'] = $matriks_keputusan;
        $this->data['matriks_normalisasi'] = $matriks_normalisasi;
        $this->data['matriks_y'] = $matriks_y;
        $this->data['solusi_ideal_positif'] = $solusi_ideal_positif;
        $this->data['solusi_ideal_negatif'] = $solusi_ideal_negatif;
        $this->data['jarak_positif'] = $jarak_positif;
        $this->data['jarak_negatif'] = $jarak_negatif;
        $this->data['kedekatan'] = $kedekatan;
    }

    public function hasil()
    {
        $this->data['title'] = "Hasil Perhitungan Topsis";
        $this->data['active'] = "hasil";
        if (PenilaianModel::countAll() == 0) {
            $this->data['message'] = "Data penilaian masih kosong. Silahkan isi data penilaian terlebih dahulu.";
            $this->data['is_empty'] = true;
        } else {
            $this->data['is_empty'] = false;
            $this->perhitungan();
        }
        $this->data['rangking'] = [];
        $i = 1;
        foreach ($this->data['kedekatan'] as $alternatif_id => $kedekatan) {
            $this->data['rangking'][] = [
                'no' => $i,
                'alternatif' => AlternatifModel::find($alternatif_id),
                'kedekatan' => $kedekatan
            ];
            $i++;
        }
        return view('Panel/Page/Perhitungan/hasil', $this->data);
    }
}
