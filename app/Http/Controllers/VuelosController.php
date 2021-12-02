<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class VuelosController extends Controller
{
    public function index(){

        $vuelos = DB::table('vuelos', 'v')
        ->join('aeropuertos AS a', 'origen_id', '=', 'a.id')
        ->join('aeropuertos AS ae', 'destino_id', '=', 'ae.id')
        ->join('companias AS c', 'compania_id', '=', 'c.id')
        ->select('v.*', 'a.denominacion as origen', 'ae.denominacion as destino', 'c.denominacion as compania' )
        ->get();

        return view('vuelos', ['vuelos' => $vuelos]);
    }
}
