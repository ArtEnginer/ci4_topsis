<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KriteriaModel extends Model
{

    protected $table = 'tb_kriteria';
    protected $fillable = ['kode', 'nama', 'bobot', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function subKriteria(): HasMany
    {
        return $this->hasMany(SubKriteriaModel::class, 'id_kriteria', 'id');
    }
}
