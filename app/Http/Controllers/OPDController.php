<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\OPD;

class OPDController extends Controller
{
    protected $route = 'config.opd.';
    protected $view  = 'pages.config.opd.';
    protected $title = 'Organisasi Perangkat Daerah';

    public function index(Request $request)
    {
        $route = $this->route;
        $title = $this->title;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('pages.config.opd.index', compact(
            'route',
            'title'
        ));
    }

    public function dataTable()
    {
        $data = OPD::queryTable();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' class='text-success mr-2' title='Edit Data'><i class='icon icon-edit'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->addColumn('total_bidang', function ($p) {
                return "<a href='" . route('config.bidang.index', array('opd_id' => $p->id)) . "' class='text-primary font-weight-bold' title='Menampilkan Bidang'>" . "<i class='mr-2 icon font-weight-bold icon-clipboard-list text-primary'></i>" . $p->bidangs->count() . "</a>";
            })
            ->editColumn('nama', function ($p) {
                return $p->nama;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama', 'total_bidang'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        OPD::create([
            'nama' => $request->nama
        ]);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }

    public function edit($id)
    {
        return OPD::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $id = $request->id;
        $nama = $request->nama;

        $data = OPD::find($id);
        $data->update([
            'nama' => $nama
        ]);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil diperbaharui."
        ]);
    }

    public function destroy($id)
    {
        OPD::destroy($id);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
}
