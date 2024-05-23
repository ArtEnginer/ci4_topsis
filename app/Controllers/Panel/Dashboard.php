<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;

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
        return view('Panel/Page/panel', $this->data);
    }
}
