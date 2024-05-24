<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class Kriteria extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->data['active'] = "kriteria";
    }

    public function index(): string
    {
        $this->data['items'] = KriteriaModel::all();

        foreach ($this->data['items'] as $item) {
            $item->subkriteria_count = SubKriteriaModel::where('kriteria_id', $item->id)->count();
        }

        return view('Panel/Page/Kriteria/index', $this->data);
    }

    public function add(): string
    {
        return view('Panel/Page/Kriteria/add', $this->data);
    }

    public function edit($id): string
    {
        $this->data['item'] = KriteriaModel::find($id);

        return view('Panel/Page/Kriteria/edit', $this->data);
    }

    // store method to add or update data
    public function storeupdate($id = null)
    {
        $data = $this->request->getPost();
        $isUniqueRule = 'required|is_unique[tb_kriteria.kode]';

        // Only generate a new unique id if $id is null (i.e., we are creating a new record)
        if ($id == null) {
        } else {
            // Fetch the current record to compare the kode value
            $currentRecord = KriteriaModel::find($id);
            if ($currentRecord && $currentRecord->kode == $data['kode']) {
                // If kode is not changed, remove the is_unique rule
                $isUniqueRule = 'required';
            }
        }

        // Validate add or update
        $rules = [
            'kode' => [
                'rules' => $isUniqueRule,
                'label' => 'Kode'
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if we are creating a new record or updating an existing one
        if ($id == null) {
            KriteriaModel::create($data);
        } else {
            KriteriaModel::find($id)->update($data);
        }

        return redirect()->route('kriteria')->with('message', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        KriteriaModel::find($id)->delete();

        return redirect()->route('kriteria')->with('message', 'Data berhasil dihapus');
    }
}
