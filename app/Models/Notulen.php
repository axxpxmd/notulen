<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $table = 'tmnotulens';
    protected $guarded = [];

    public static function queryTable($id_opd, $tanggal_mulai, $tanggal_akhir, $status_filter)
    {
        $data = Notulen::select('id','id_opd', 'id_bidang', 'id_sub_bidang', 'judul_agenda', 'tanggal_agenda', 'waktu', 'tempat', 'acuan', 'file_acuan', 'keterangan', 'file_notulen')
        ->when($id_opd, function($q) use($id_opd){
            return $q->where('id_opd', $id_opd);
        })
        ->when($status_filter, function($q) use($status_filter){
            return $q->where('status', $status_filter);
        });
        
        if ($tanggal_mulai != null ||  $tanggal_akhir != null) {
            $data->whereBetween('tanggal_agenda', [$tanggal_mulai, $tanggal_akhir]);
        }

        return $data->orderBy('id', 'DESC');
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_notulen', 'id');
    }
}
