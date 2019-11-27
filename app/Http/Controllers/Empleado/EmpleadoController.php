<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Departamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HepplerDotNet\FlashToastr\Flash;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::with('departamento')->get();

        foreach ($empleados as $empleado) {
            $empleado['nombre_completo'] = $empleado->primer_nombre. ' '.$empleado->segundo_nombre. ' '.$empleado->primer_apellido. ' '.$empleado->segundo_apellido;
        }
        return datatables()->collection($empleados)
                           ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all();
        return view('empleado.create',compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
               'cui' => 'required|string|max:25',
               'primer_nombre' => 'required|string|max:50',
               'primer_apellido' => 'required|string|max:50',
               'departamento_id' => 'required|integer',
               'extension' => 'required',
               'cargo' => 'required'
            ];            
        $this->validate($request, $rules);
        try {
            $data = $request->all();
            Empleado::create($data);
            toastr()->success('Empleado agregado correctamente!');

            return redirect('/');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());

            return redirect()
                ->back()
                ->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $departamentos = Departamento::all();
        return view('empleado.edit',compact('departamentos','empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $rules = [
               'cui' => 'required|string|max:25',
               'primer_nombre' => 'required|string|max:50',
               'primer_apellido' => 'required|string|max:50',
               'departamento_id' => 'required|integer',
               'extension' => 'required',
               'cargo' => 'required'
            ];            
        $this->validate($request, $rules);

        $empleado->cui = $request->cui;
        $empleado->primer_nombre = $request->primer_nombre;
        $empleado->segundo_nombre = $request->segundo_nombre;
        $empleado->primer_apellido = $request->primer_apellido;
        $empleado->segundo_apellido = $request->segundo_apellido;
        $empleado->extension = $request->extension;
        $empleado->cargo = $request->cargo;

         try {
            $empleado->save();
            toastr()->success('Empleado editado con exito correctamente!');

            return redirect('/');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());

            return redirect()
                ->back()
                ->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $usuarios = $empleado->usuarios()->withTrashed()->get();
        $mensaje = 'empleado eliminado con exito';

        if(count($usuarios)){
            toastr()->error('no se puede eliminar empledo porque tiene un usuario asociado');
            return [
                'mensaje' => $mensaje,
                'error' => true
            ];
        }

         try {
            $empleado->delete();
            toastr()->success('Empleado eliminado correctamente!');
             return [
                'mensaje' => $mensaje,
                'error' => false
            ];

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
             return [
                'mensaje' => $mensaje,
                'error' => true
            ];
        }
    }
}
