<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternatifModel extends Model
{

    protected $table = 'tb_alternatif';
    protected $fillable = ['nama', 'nip', 'tempat_lahir', 'tanggal_lahir', 'bidang_tugas', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    public static function countAll()
    {
        return self::count();
    }
}
