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

namespace App\Http\Controllers;

use App\Models\Notulen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $totalNotulen = Notulen::count();
        $notulenDisetujui = Notulen::where('status', 1)->count();
        $notulenBelumDitinjau = Notulen::where('status', 0)->count();
        $notulenDitolak = Notulen::where('status', 2)->count();

        return view('home', compact(
            'totalNotulen',
            'notulenDisetujui',
            'notulenBelumDitinjau',
            'notulenDitolak'
        ));
    }
}
