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

// Model
use App\User;
use App\Models\OPD;
use App\Models\Pengguna;
use App\Models\ModelHasRoles;
use App\Models\OPDJenisPendapatan;
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

        if ($request->ajax()) {
            return $this->dataTable();
        }

        $opds = OPD::select('id', 'nama')->get();
        $roles = Role::select('id', 'name')->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'opds',
            'roles'
        ));
    }

    public function dataTable()
    {
        $data = User::select('id', 'id_opd', 'username', 'nama')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>
                <a href='#' onclick='show(" . $p->id . ")' title='show data'><i class='icon icon-eye3 mr-1'></i></a>";
            })
            ->editColumn('nama', function ($p) {
                return "<a href='" . route($this->route . 'edit', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->nama . "</a>";
            })
            ->editColumn('opd', function ($p) {
                if ($p->opd == null) {
                    return '-';
                } else {
                    return $p->opd->nama;
                }
            })
            ->editColumn('username', function ($p) {
                return $p->username;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama'])
            ->toJson();
    }

    public function show($id)
    {
        // 
    }

    public function store(Request $request)
    {
        // 
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
        //    
    }

    public function destroy($id)
    {
        // 
    }
}
