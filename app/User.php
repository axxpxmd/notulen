<?php

namespace App;

use App\Models\Bidang;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Models
use App\Models\OPD;
use App\Models\Sub_bidang;
use App\Models\ModelHasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = 'tmusers';
    protected $fillable = ['id', 'id_opd', 'id_bidang', 'id_sub_bidang', 'username', 'password', 'nama', 'foto'];
    protected $hidden = ['password'];

    public static function queryTable($opd_id, $role_id)
    {
        $datas = User::select('id', 'id_opd', 'username', 'nama')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'tmusers.id')
            ->when($opd_id != 0, function ($q) use ($opd_id) {
                return $q->where('id_opd', $opd_id);
            })
            ->when($role_id != 0, function ($q) use ($role_id) {
                return $q->where('model_has_roles.role_id', $role_id);
            })
            ->whereNotIn('id', [1]);

        return $datas->orderBy('id', 'DESC')->get();
    }

    public function modelHasRole()
    {
        return $this->belongsTo(ModelHasRoles::class, 'id', 'model_id');
    }

    public function opd()
    {
        return $this->belongsTo(OPD::class, 'id_opd');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }

    public function sub_bidang()
    {
        return $this->belongsTo(Sub_bidang::class, 'id_sub_bidang');
    }
}
