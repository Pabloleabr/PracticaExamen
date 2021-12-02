<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    public function reservar($id){

        

        DB::table('reservas')->insert([

        ]);

        return redirect()->back()->with('success','reserva hecha con existo');
    }
}
