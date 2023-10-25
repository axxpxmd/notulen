<?php

namespace App\Http\Controllers;

use DataTables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Notulen;

class NotulenController extends Controller
{
    protected $route = 'notulen.';
    protected $view  = 'pages.notulen.index.';
    protected $title = 'Notulen';

    public function index(Request $request)
    {
        $route = $this->route;
        $title = $this->title;

        if ($request->ajax()) {
            return $this->dataTable();
        }

        return view('pages.notulen.index', compact(
            'route',
            'title'
        ));
    }

    public function dataTable()
    {
        $data = Notulen::queryTable();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' class='text-success mr-2' title='Edit Data'><i class='icon icon-edit'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'acuan' => 'required',
            'judul_agenda' => 'required',
            'tanggal_agenda' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'file_notulen' => 'required'
        ]);

        //* Get Params
        $acuan = $request->acuan;
        $judul_agenda = $request->judul_agenda;
        $tanggal_agenda = $request->tanggal_agenda;
        $waktu = $request->waktu;
        $tempat = $request->tempat;
        $keterangan = $request->keterangan;

        $file_acuan = $request->file('file_acuan');
        $file_notulen = $request->file('file_notulen');
        $foto_rapat = $request->file('foto_rapat');

        if ($file_acuan) {
            $ext = $request->file('file_acuan')->extension();
            if (!in_array($ext, ['pdf', 'png', 'jpeg', 'jpg']))
                return response()->json([
                    'message' => 'Format file tidak diperbolehkan'
                ], 500);

            //TODO: Saved to storage
            $fileName = time() . "-" . mt_rand(0, 999) . "." . $ext;
            $file_acuan->storeAs('file-acuan/', $fileName, 'sftp', 'public');
        }

        if ($file_notulen) {
            $ext = $request->file('file_notulen')->extension();
            if (!in_array($ext, ['pdf', 'png', 'jpeg', 'jpg']))
                return response()->json([
                    'message' => 'Format file tidak diperbolehkan'
                ], 500);

            //TODO: Saved to storage
            $fileName = time() . "-" . mt_rand(0, 999) . "." . $ext;
            $file_notulen->storeAs('file-notulen/', $fileName, 'sftp', 'public');
        }

        if ($foto_rapat) {
            foreach ($foto_rapat as $key => $i) {
                $ext = $foto_rapat[$key]->extension();
                if (!in_array($ext, ['pdf', 'png', 'jpeg', 'jpg']))
                    return response()->json([
                        'message' => 'Format file tidak diperbolehkan'
                    ], 500);

                //TODO: Saved to storage 
                $fileName = time() . "-" . mt_rand(0, 999) . "." . $ext;
                $foto_rapat[$key]->storeAs('foto-rapat/', $fileName, 'sftp', 'public');
            }
        }

        dd('berhasil');
    }
}
