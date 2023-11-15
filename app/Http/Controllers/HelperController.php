<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Bidang;
use App\Models\Sub_bidang;

class HelperController extends Controller
{
    public function getBidangByOpd($id_opd)
    {
        return Bidang::where('opd_id', $id_opd)->get();
    }

    public function getSubBidangByBidang($id_bidang)
    {
        return Sub_bidang::where('id_bidang', $id_bidang)->get();
    }
}
