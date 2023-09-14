<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'tmbidangs';
    protected $guarded = [];

    public static function queryTable($opd_id) 
    {
        $data = Bidang::select('id', 'opd_id', 'nama')->where('opd_id', $opd_id);

        return $data->orderBy('id', 'DESC');
    }

    public function subBidangs()
    {
        return $this->hasMany(Sub_bidang::class, 'id_bidang', 'id');
    }
}
