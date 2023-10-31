<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of welcome
 *
 * @author Asip Hamdi
 * Github : axxpxmd
 */

namespace App\Http\Controllers\MasterRole;

use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
// Model
use App\User;
use App\Models\OPD;
use App\Models\Pengguna;
use App\Models\ModelHasRoles;
use App\Models\OPDJenisPendapatan;
use App\Models\Sub_bidang;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    protected $route = 'master-role.pengguna.';
    protected $view  = 'pages.masterRole.pengguna.';
    protected $title = 'Pengguna';

    // Check Permission
    public function __construct()
    {
        $this->middleware(['permission:Pengguna']);
    }

    public function index(Request $request)
    {
        $route = $this->route;
        $title = $this->title;

        $opd_id  = $request->opd_id_filter;
        $role_id = $request->role_id_filter;

        if ($request->ajax()) {
            return $this->dataTable($opd_id, $role_id);
        }

        $opds = OPD::select('id', 'nama')->get();
        $roles = Role::select('id', 'name')->whereNotIn('id', [5])->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'opds',
            'roles'
        ));
    }

    public function dataTable($opd_id, $role_id)
    {
        $data = user::queryTable($opd_id, $role_id);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>";
            })
            ->editColumn('nama', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->nama . "</a>";
            })
            ->editColumn('opd', function ($p) {
                if ($p->opd == null) {
                    return '-';
                } else {
                    return $p->opd->nama;
                }
            })
            ->addColumn('role', function ($p) {
                return $p->modelHasRole->role->name;
            })
            ->editColumn('username', function ($p) {
                return $p->username;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama'])
            ->toJson();
    }

    public function getBidangByOpd($id_opd)
    {
        return Bidang::where('opd_id', $id_opd)->get();
    }

    public function getSubBidangByBidang($id_bidang)
    {
        return Sub_bidang::where('id_bidang', $id_bidang)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id'  => 'required',
            'username' => 'required|unique:tmusers,username',
            'password' => 'required',
            'nama'     => 'required',
            'id_opd'   => 'required'
        ]);

        //TODO: Validation for role operator
        if ($request->role_id == 14) {
            $request->validate([
                'id_bidang' => 'required',
                'id_sub_bidang' => 'required'
            ]);
        }

        //* params
        $role_id  = $request->role_id;
        $username = $request->username;
        $password = $request->password;
        $nama   = $request->nama;
        $id_opd = $request->id_opd;
        $id_bidang     = $request->id_bidang;
        $id_sub_bidang = $request->id_sub_bidang;
        $foto = $request->file('foto');

        /**
         * Tahapan
         * 1. tmusers
         * 2. model_has_roles
         */

        //  Save Foto
        if ($foto) {
            $ext = $request->file('foto')->extension();
            if (!in_array($ext, ['png', 'jpeg', 'jpg']))
                return response()->json([
                    'message' => 'Format file tidak diperbolehkan'
                ], 500);

            //TODO: Saved to storage
            $fileNameFoto = time() . "-" . mt_rand(0, 999) . "." . $ext;
            $foto->storeAs('foto-user/', $fileNameFoto, 'sftp', 'public');
        }

        //* Tahap 1
        $user = User::create([
            'id_opd' => $id_opd,
            'id_bidang' => $id_bidang,
            'id_sub_bidang' => $id_sub_bidang,
            'username' => $username,
            'password' => Hash::make($password),
            'nama' => $nama,
            'foto' => $foto ? $fileNameFoto : 'default.png'
        ]);

        //* Tahap 2
        $model_has_role = new ModelHasRoles();
        $model_has_role->role_id    = $role_id;
        $model_has_role->model_type = 'app\User';
        $model_has_role->model_id   = $user->id;
        $model_has_role->save();

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;

        $data = User::find($id);
        $roles = Role::all();

        return view($this->view . 'show', compact(
            'route',
            'title',
            'data',
            'roles'
        ));
    }
}
