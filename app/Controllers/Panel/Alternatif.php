<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\AlternatifModel;

class Alternatif extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->data['active'] = "alternatif";
    }

    public function index(): string
    {
        $this->data['items'] = AlternatifModel::all();

        return view('Panel/Page/Alternatif/index', $this->data);
    }

    public function add(): string
    {
        return view('Panel/Page/Alternatif/add', $this->data);
    }

    public function edit($id): string
    {
        $this->data['item'] = AlternatifModel::find($id);

        return view('Panel/Page/Alternatif/edit', $this->data);
    }

    // store method to add or update data
    public function storeupdate($id = null)
    {
        $data = $this->request->getPost();
        $isUniqueRule = 'required|is_unique[tb_alternatif.nip]';

        // Only generate a new unique id if $id is null (i.e., we are creating a new record)
        if ($id == null) {
        } else {
            // Fetch the current record to compare the nip value
            $currentRecord = AlternatifModel::find($id);
            if ($currentRecord && $currentRecord->nip == $data['nip']) {
                // If nip is not changed, remove the is_unique rule
                $isUniqueRule = 'required';
            }
        }

        // Validate add or update
        $rules = [
            'nip' => [
                'rules' => $isUniqueRule,
                'label' => 'nip'
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if we are creating a new record or updating an existing one
        if ($id == null) {
            AlternatifModel::create($data);
        } else {
            AlternatifModel::find($id)->update($data);
        }

        return redirect()->route('alternatif')->with('message', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        AlternatifModel::find($id)->delete();

        return redirect()->route('alternatif')->with('message', 'Data berhasil dihapus');
    }
}
