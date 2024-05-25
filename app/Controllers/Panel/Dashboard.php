<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\AlternatifModel;


class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->data['active'] = "dashboard";
    }

    public function index(): string
    {
        $this->data['title'] = "Dashboard";
        $this->data['total_kriteria'] = KriteriaModel::countAll();
        $this->data['total_subkriteria'] = SubKriteriaModel::countAll();
        $this->data['total_alternatif'] = AlternatifModel::countAll();

        return view('Panel/Page/panel', $this->data);
    }
}
