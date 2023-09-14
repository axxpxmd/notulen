<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\OPD;
use App\Models\Bidang;

class BidangController extends Controller
{
    protected $route = 'config.bidang.';
    protected $view  = 'pages.config.bidang.';
    protected $title = 'Bidang';

    public function index(Request $request)
    {
        $route  = $this->route;
        $title  = $this->title;
        $opd_id = $request->opd_id;

        $opd = OPD::find($opd_id);

        if ($request->ajax()) {
            return $this->dataTable($opd_id);
        }

        return view('pages.config.bidang.index', compact(
            'route',
            'title',
            'opd_id',
            'opd'
        ));
    }

    public function dataTable($opd_id)
    {
        $data = Bidang::queryTable($opd_id);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' class='text-success mr-2' title='Edit Data'><i class='icon icon-edit'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->addColumn('total_sub_bidang', function ($p) {
                return "<a href='" . route('config.sub-bidang.index', array('id_bidang' => $p->id)) . "' class='text-primary font-weight-bold' title='Menampilkan Sub Bidang'>" . "<i class='mr-2 icon font-weight-bold icon-clipboard-list text-primary'></i>" . $p->subBidangs->count() . "</a>";
            })
            ->editColumn('nama', function ($p) {
                return $p->nama;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama', 'total_sub_bidang'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Bidang::create([
            'nama' => $request->nama,
            'opd_id' => $request->id_opd
        ]);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }

    public function edit($id) 
    {
        return Bidang::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $id = $request->id;
        $nama = $request->nama;

        $data = Bidang::find($id);
        $data->update([
            'nama' => $nama
        ]);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil diperbaharui."
        ]);
    }

    public function destroy($id)
    {
        Bidang::destroy($id);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
}
