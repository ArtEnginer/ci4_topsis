<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // auto redirect to panel
        return redirect()->to('panel');
    }
}
