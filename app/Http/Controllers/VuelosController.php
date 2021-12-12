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
        ->select('v.codigo','ae.denominacion AS origen', 'a.denominacion AS destino', 'c.denominacion AS compania'
                , 'v.salida', 'asientos', 'precio');

        $vuelos->orderBy($orden);

        //borrar reescribir sin la funcion a que no funciona para todos los casos
        function buscar(&$var, $nombre, $prefijo, &$vuelos)
        {
            if(($var = request()->query($nombre)) !== null){
                $vuelos->where($prefijo . $nombre, 'ilike', "%$var%");
            }
        }
        buscar($codigo, 'codigo', 'v.', $vuelos);
        /*
        tendria que acerlos por separado con una subconsulta que pillara el id atravez del nombre
        buscar($origen, 'origen_id', '', $vuelos);
        buscar($destino, 'destino_id', '', $vuelos);
        buscar($compania, 'compania_id', '', $vuelos); */
        buscar($salida, 'salida', 'v.', $vuelos);
        buscar($asientos, 'asientos', '', $vuelos);
        buscar($precio, 'precio', '', $vuelos);

        $paginado = $vuelos->paginate(2);
        $paginado->appends(compact(
            'codigo', /* 'origen', 'destino', 'compania', */ 'salida', 'asientos', 'precio', 'orden'
        ));

        return view('vuelos', [
            'vuelos'=>$paginado,
        ]);
    }
}
