<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianModel extends Model
{

    protected $table = 'tb_penilaian';
    protected $fillable = ['alternatif_id', 'sub_kriteria_id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function alternatif()
    {
        return $this->belongsTo(AlternatifModel::class, 'alternatif_id');
    }

    public function sub_kriteria()
    {
        return $this->hasMany(SubKriteriaModel::class, 'id', 'sub_kriteria_id');
    }

    public static function countAll()
    {
        return self::count();
    }
}
