<?php

namespace App\Controllers;

use Exception;
use Throwable;

use CodeIgniter\Shield\Entities\User;

class Migrate extends BaseController
{
    public function index()
    {
        if (file_exists(WRITEPATH . 'storage/store.json')) {
            unlink(WRITEPATH . 'storage/store.json');
        }

        $dbname = env('database.default.database');

        try {
            $forge = \Config\Database::forge();
            $migrate = \Config\Services::migrations();
            $seeder = \Config\Database::seeder();
            $db = \Config\Database::connect();

            $tables = $db->listTables();

            foreach ($tables as $table) {
                $forge->dropTable($table, true);
            }

            $migrate->setNamespace('CodeIgniter\Settings')->latest();
            $migrate->setNamespace('CodeIgniter\Shield')->latest();
            $migrate->setNamespace('App')->latest();

            $seeder->call('Init');
            $users = auth()->getProvider();
            $user = new User([
                'username' => 'admin',
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'password' => '12345678',
            ]);
            $users->save($user);
            $user = $users->findById($users->getInsertID());
            $user->addGroup('admin');
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }

        return 'berhasil migrate database, <a href="' . base_url() . '">Kembali</a>';
    }
}
