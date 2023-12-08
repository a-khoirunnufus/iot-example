<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TankController extends Controller
{
    public function datatable()
    {
        $query = DB::table('tank_history');

        $datatable = datatables($query);

        return $datatable->toJson();
    }
}
