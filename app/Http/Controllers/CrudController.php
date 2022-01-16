<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{

    /**
     * index
     * devuelve vista inicial con datos solicitados
     * @return void
     */
    public function index()
    {
        $alumnos = DB::table('v_alumnos')
            ->select('id', 'nombre', DB::raw('ROUND(AVG(nota), 1) AS nota'))
            ->groupBy('id', 'nombre');

        $paginador = $alumnos->paginate(50);


        return view('alumnos.index', [
            'alumnos' => $paginador,
        ]);
    }

    /**
     * create
     * devuelve la vista con formulario utilizado guardar información
     * @return void
     */
    public function create()
    {
        $alumno = (object) [
            'nombre' => null,
        ];
        return view('alumnos.create', [
            'alumno' => $alumno,
        ]);
    }
    /**
     * store
     * valida y guarda los datos enviados con post
     * @return void
     */
    public function store()
    {
        $validados = $this->validar();

        DB::table('alumnos')->insert([
            'nombre' => $validados['nombre'],
        ]);

        return redirect('/alumnos')
            ->with('success', 'Alumno insertado con éxito.');
    }


    /**
     * edit
     * devulve la vista con el formulario para el elemento seleccionado
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $alumno = $this->findAlumno($id);
        return view('alumnos.edit', [
            'alumno' => $alumno,
        ]);
    }
    /**
     * update
     * valida y actualiza los datos mandados por un post
     * y la id del elemento(en la ruta)
     * @param  mixed $id
     * @return void
     */
    public function update($id)
    {
        $validados = $this->validar();
        $this->findAlumno($id);

        DB::table('alumnos')
            ->where('id', $id)
            ->update([
                'nombre' => $validados['nombre'],
            ]);
        return redirect('/alumnos')
            ->with('success', 'Alumno modificado con éxito.');
    }

    /**
     * destroy
     * borra el elemento enviado por url de la ase datos, si este existe
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $this->findAlumno($id);
        DB::delete('DELETE FROM alumnos WHERE id = ?', [$id]);

        return redirect()->back()
        ->with('success', 'Alumno borrado correctamente');
    }

    public function criterios($id)
    {
        $alumno = $this->findAlumno($id);
        $notas = DB::table('notas')
        ->select('ce', DB::raw('MAX(nota) AS nota'))
        ->join('ccee AS c', 'ce_id', '=', 'c.id')
        ->where('alumno_id', $id)
        ->groupBy('ce_id', 'ce')
        ->get();
        return view('alumnos.criterios', [
            'alumno' => $alumno,
            'notas' => $notas,
        ]);
    }
    /**
     * validar
     * valida el dato de nombre enviado
     * @return array
     */
    private function validar()
    {
        $validados = request()->validate([
            'nombre' => 'required|max:255',
        ]);
        return $validados;
    }

    /**
     * findAlumno
     * encuentra el elemento con el id pasado
     * @param  mixed $id
     * @return mixed Collection
     */
    private function findAlumno($id)
    {
        $alumnos = DB::table('alumnos')
        ->where('id', $id)
            ->get();
            abort_if($alumnos->isEmpty(), 404);

            return $alumnos->first();
    }
}
