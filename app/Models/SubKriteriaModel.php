<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubKriteriaModel extends Model
{
    // use HasUuids;

    protected $table = 'tb_sub_kriteria';
    protected $fillable = ['kriteria_id', 'nama', 'bobot', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function kriteria(): HasMany
    {
        return $this->hasMany(KriteriaModel::class, 'id_kriteria', 'id');
    }

    public static function countAll()
    {
        return self::count();
    }
}
