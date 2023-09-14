<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OPD extends Model
{
    protected $table = 'tmopds';
    protected $guarded = [];

    public static function queryTable()
    {
        $data = OPD::select('id', 'nama');

        return $data->orderBy('id', 'DESC');
    }

    public function bidangs()
    {
        return $this->hasMany(Bidang::class, 'opd_id', 'id');
    }
}
