<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User as UserEntity;

class User extends BaseController
{
    protected $userModel;
    protected $validation;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation(); // Panggil library validasi
        $this->data['active'] = 'user';
    }

    public function index()
    {
        $this->data['items'] = $this->userModel->findAll();
        dd();
        return view('Panel/Page/User/index', $this->data);
    }

    public function add()
    {
        if ($_POST) {
            $this->validation->setRules([
                'username' => 'required|is_unique[users.username]',
                'email'    => 'required|valid_email|is_unique[auth_identities.secret]',
                'password' => 'required',
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $users = auth()->getProvider();
                $user = new UserEntity([
                    'username' => $this->request->getPost('username'),
                    'email'    => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                ]);
                $role = $this->request->getPost('role');
                $users->save($user);
                $user = $users->findById($users->getInsertID());
                $user->addGroup((string)$role);
                return redirect()->route('user')->with('message', 'Data berhasil disimpan');
            } else {
                $validationErrors = $this->validation->getErrors();
                return redirect()->back()->withInput()->with('error', implode('<br>', $validationErrors));
            }
        }
        return view('Panel/Page/User/add', $this->data);
    }

    public function edit($id)
    {
        if ($_POST) {
            $this->validation->setRules([
                'password' => 'required',
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $users = auth()->getProvider();

                $user = $users->findById($id);
                $user->fill([
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password')
                ]);
                $users->save($user);
                return redirect()->route('user')->with('message', 'Data berhasil diperbarui');
            } else {
                $validationErrors = $this->validation->getErrors();
                return redirect()->back()->withInput()->with('error', implode('<br>', $validationErrors));
            }
        }

        $this->data['item'] = $this->userModel->find($id);
        return view('Panel/Page/User/edit', $this->data);
    }

    public function delete($id)
    {
        $users = auth()->getProvider();
        $users->delete($id, true);
        return redirect()->route('user')->with('message', 'Data berhasil dihapus');
    }
}
