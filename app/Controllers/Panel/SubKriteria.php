<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteria extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->data['active'] = "kriteria";
    }

    public function index($id): string
    {
        $this->data['items'] = SubKriteriaModel::where('kriteria_id', $id)->get();
        $this->data['kriteria'] = KriteriaModel::find($id);

        return view('Panel/Page/SubKriteria/index', $this->data);
    }

    public function add($id): string
    {
        $this->data['kriteria'] = KriteriaModel::find($id);

        return view('Panel/Page/SubKriteria/add', $this->data);
    }


    public function edit($id): string
    {
        $this->data['item'] = SubKriteriaModel::find($id);

        return view('Panel/Page/Kriteria/edit', $this->data);
    }

    // store method to add or update data
    public function storeupdate($id = null)
    {
        $data = $this->request->getPost();
        $data['kriteria_id'] = $data['kriteria_id'];

        // Check if we are creating a new record or updating an existing one
        if ($id == null) {
            SubKriteriaModel::create($data);
        } else {
            SubKriteriaModel::find($id)->update($data);
        }

        return redirect()->route('kriteria.subkriteria', [$data['kriteria_id']])->with('message', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        SubKriteriaModel::find($id)->delete();

        return redirect()->back()->with('message', 'Data berhasil dihapus');
    }
}
