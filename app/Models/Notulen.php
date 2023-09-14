<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $table = 'tmnotulens';
    protected $guarded = [];

    public static function queryTable()
    {
        $data = Notulen::select('id', 'id_sub_bidang', 'judul_agenda', 'tanggal_agenda', 'waktu', 'tempat', 'acuan', 'file_acuan', 'keterangan', 'file_notulen');

        return $data->orderBy('id', 'DESC');
    }
}
