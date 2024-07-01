<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\PenilaianModel;

class Penilaian extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->data['active'] = "penilaian";
    }

    public function index(): string
    {
        $this->data['items'] = PenilaianModel::all();
        $this->data['kriteria'] = KriteriaModel::all();
        $this->data['sub_kriteria'] = SubKriteriaModel::all();
        $this->data['alternatif'] = AlternatifModel::all();


        return view('Panel/Page/Penilaian/index', $this->data);
    }

    public function add(): string
    {
        $this->data['alternatif'] = AlternatifModel::whereNotIn('id', PenilaianModel::select('alternatif_id')->distinct()->get()->pluck('alternatif_id'))->get();
        $this->data['kriteria'] = KriteriaModel::all();
        $this->data['sub_kriteria'] = SubKriteriaModel::all();
        $this->data['items'] = PenilaianModel::with('alternatif')->get();
        return view('Panel/Page/Penilaian/add', $this->data);
    }

    public function edit($id): string
    {
        $this->data['item'] = PenilaianModel::with('alternatif')->find($id);
        $this->data['kriteria'] = KriteriaModel::all();
        $this->data['sub_kriteria'] = SubKriteriaModel::all();

        return view('Panel/Page/Penilaian/edit', $this->data);
    }

    // store method to add or update data
    public function storeupdate($id = null)
    {
        $data = $this->request->getPost();
        $data['sub_kriteria_id'] = json_encode($data['sub_kriteria_id']);

        if ($id == null) {
            PenilaianModel::create($data);
        } else {
            PenilaianModel::find($id)->update($data);
        }

        return redirect()->route('penilaian')->with('message', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        PenilaianModel::find($id)->delete();

        return redirect()->route('penilaian')->with('message', 'Data berhasil dihapus');
    }
}
