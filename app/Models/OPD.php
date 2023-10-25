<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
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

    public static function getOpd($id_opd, $role)
    {
        $data = OPD::select('id', 'nama')
            ->when($id_opd != 0 && $role == 'operator' , function ($q) use ($id_opd) {
                return $q->where('id', $id_opd);
            })->get();

        return $data;
    }
}
