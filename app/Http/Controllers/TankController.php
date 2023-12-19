<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TankController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->get('filters');

        $query = DB::table('tank_history');

        if ($filters['tank'] && $filters['tank'] != '<ALL>') {
            $query->where('tank', '=', $filters['tank']);
        }

        if (isset($filters['date'])) {
            $query->where('date', '=', $filters['date']);
        } else {
            $query->where('time', '=', '07:00:00');
        }

        return $query->get()->toArray();
    }

    public function datatable(Request $request)
    {
        $filters = $request->get('filters');
        $type = $request->get('type');

        $query = DB::table('tank_history');

        if ($type == 'per-day') {
            $query->where('time', '=', '07:00:00');
        }

        if ($filters['tank'] && $filters['tank'] != '<ALL>') {
            $query->where('tank', $filters['tank']);
        }

        if ($filters['date_start']) {
            $query->where('date', '>=', $filters['date_start']);
        }

        if ($filters['date_end']) {
            $query->where('date', '<=', $filters['date_end']);
        }

        $datatable = datatables($query);

        return $datatable->toJson();
    }


}
