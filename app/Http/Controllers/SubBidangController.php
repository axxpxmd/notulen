<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Bidang;
use App\Models\Sub_bidang;

class SubBidangController extends Controller
{
    protected $route = 'config.sub-bidang.';
    protected $view  = 'pages.config.sub-bidang.';
    protected $title = 'Sub Bidang';

    public function index(Request $request)
    {
        $route  = $this->route;
        $title  = $this->title;
        $id_bidang = $request->id_bidang;

        $bidang = Bidang::find($id_bidang);

        if ($request->ajax()) {
            return $this->dataTable($id_bidang);
        }

        return view('pages.config.sub-bidang.index', compact(
            'route',
            'title',
            'id_bidang',
            'bidang'
        ));
    }

    public function dataTable($id_bidang)
    {
        $data = Sub_bidang::queryTable($id_bidang);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' class='text-success mr-2' title='Edit Data'><i class='icon icon-edit'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('nama', function ($p) {
                return $p->nama;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Sub_bidang::create([
            'nama' => $request->nama,
            'id_bidang' => $request->id_bidang
        ]);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }
    public function edit($id)
    {
        return Sub_bidang::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $id = $request->id;
        $nama = $request->nama;

        $data = Sub_bidang::find($id);
        $data->update([
            'nama' => $nama
        ]);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil diperbaharui."
        ]);
    }

    public function destroy($id)
    {
        Sub_bidang::destroy($id);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
}
