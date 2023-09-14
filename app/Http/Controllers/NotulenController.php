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
}
