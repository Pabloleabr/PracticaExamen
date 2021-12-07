<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    public function reservar($id){

        $user = $this->getCurrentUserid();


        $validados = request()->validate([
            'asiento' => 'required|integer',
        ]);
        $fecha = new DateTime();

        DB::table('reservas')->insert([
            'usuario_id' => $user[0]->id,
            'vuelo_id' => $id,
            'asiento' => $validados['asiento'],
            'fecha_hora' => $fecha->format('d-m-Y H:i:s')
        ]);

        return redirect()->back()->with('success','reserva hecha con existo');
    }

    public function reservas()
    {
        $reservas = DB::table('reservas','r')
        ->join('vuelos as v', 'r.vuelo_id', '=', 'v.id')
        ->where('usuario_id','=', $this->getCurrentUserid())
        ->get();

        return view('reservas', [
            'reservas'=> $reservas
        ]);
    }

    public function show($id)
    {
        $validados = request()->validate([
            'asiento' => 'required|integer',
        ]);

        $reservas = DB::table('reservas','r')
        ->join('vuelos as v', 'r.vuelo_id', '=', 'v.id')
        ->join('aeropuertos AS a', 'origen_id', '=', 'a.id')
        ->join('aeropuertos AS ae', 'destino_id', '=', 'ae.id')
        ->join('companias AS c', 'compania_id', '=', 'c.id')
        ->where('v.id','=', $id)
        ->where('r.asiento','=',$validados['asiento'])
        ->select('r.*','v.*', 'a.denominacion as origen', 'ae.denominacion as destino', 'c.denominacion as compania' )
        ->get();

        return view('show',[
            'reservas' => $reservas
        ]);
    }

    private function getCurrentUserid()
    {
        $user = DB::table('users')->where('email','=',session('usuario'))->select('id')->get();
        return $user[0]->id;
    }
}
