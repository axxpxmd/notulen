<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_bidang extends Model
{
    protected $table = 'tmsub_bidangs';
    protected $guarded = [];

    public static function queryTable($id_bidang)
    {
        $data = Sub_bidang::select('id', 'id_bidang', 'nama')->where('id_bidang', $id_bidang);

        return $data->orderBy('id', 'DESC');
    }
}
