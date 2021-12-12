<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VuelosController extends Controller
{
    public function index()
    {
        $orden = request()->query('orden') ?: 'codigo';

        $vuelos = DB::table('vuelos', 'v')
        ->join('aeropuertos AS ae', 'origen_id', '=', 'ae.id')
        ->join('aeropuertos AS a', 'destino_id', '=', 'a.id')
        ->join('companias AS c', 'compania_id', '=', 'c.id')
        ->select('v.*','ae.denominacion AS origen', 'a.denominacion AS destino', 'c.denominacion AS compania');

        $vuelos->orderBy($orden);

        function buscar(&$var, $nombre, &$vuelos)
        {
            if(($var = request()->query($nombre)) !== null){
                $vuelos->where($nombre, 'ilike', "%$var%");
            }
        }
        buscar($codigo, 'codigo', $vuelos);
        buscar($origen, 'origen', $vuelos);
        buscar($destino, 'destino', $vuelos);
        buscar($compania, 'compania', $vuelos);
        buscar($salida, 'salida', $vuelos);
        buscar($asientos, 'asientos', $vuelos);
        buscar($precio, 'precio', $vuelos);

        $paginado = $vuelos->paginate(2);
        $paginado->appends(compact(
            'codigo', 'origen', 'destino', 'compania', 'salida', 'asientos', 'precio', 'orden'
        ));

        return view('vuelos', [
            'vuelos'=>$paginado,
        ]);
    }
}
