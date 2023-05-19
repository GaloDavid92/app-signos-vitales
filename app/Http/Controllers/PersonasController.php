<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::all();
        return view('personas', ['personas' => $personas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     ''
        // ])
        $p = new Persona();
        $p->nombre = $request->nombre;
        $p->apellido = $request->apellido;
        $p->identificacion = $request->identificacion;
        $p->fecha_nacimiento = $request->fecha_nacimiento;
        $p->sexo = $request->sexo;
        $p->diagnostico = $request->diagnostico;
        $p->prescripcion_medica = $request->prescripcion_medica;
        $p->observacion = $request->observacion;
        $p->save();

        return redirect()->route('personas')->with('success', 'Persona creada');
    }

    /**
     * Search a newly created resource in storage.
     */
    public function search(Request $request)
    {
        $personaBuscar = explode(" ", $request->personaBuscar);
        $personaBuscada = Persona::where('nombre', $personaBuscar[0])->first();
        if(sizeof($personaBuscar)>1){
            $personaBuscada = Persona::where('nombre', $personaBuscar[0])->where('apellido', $personaBuscar[1])->first();
        }

        if($personaBuscada == null){
            return redirect()->route('personas')->with('success', 'No existen registros de ' . $request->personaBuscar);
        }
        else
        {
            $strId = strval($personaBuscada->id);
            return redirect()->route('signos_vitales', $strId)->with('success', 'Registro guardado');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_persona)
    {        
        $personas = Persona::all();
        $persona = Persona::find($id_persona);
        $problems = array(
            'frecuencia_cardiaca' => 0,
            'frecuencia_respiratoria' => 0,
            'presion_sistolica' => 0,
            'presion_diastolica' => 0,
            'temperatura' => 0,
        );
        $fc = [];
        $fr = [];
        $ps = [];
        $pd = [];
        $tm = [];
        foreach ($persona->signosVitales as $sv) {
            array_push($fc, array(
                "label" => $sv->created_at,
                "y" => $sv->frecuencia_cardiaca,
            ));
            array_push($fr, array(
                "label" => $sv->created_at,
                "y" => $sv->frecuencia_respiratoria,
            ));
            array_push($ps, array(
                "label" => $sv->created_at,
                "y" => $sv->presion_sistolica,
            ));
            array_push($pd, array(
                "label" => $sv->created_at,
                "y" => $sv->presion_diastolica,
            ));
            array_push($tm, array(
                "label" => $sv->created_at,
                "y" => floatval($sv->temperatura),
            ));
            if ($sv->frecuencia_cardiaca < 60 || $sv->frecuencia_cardiaca > 80) {
                $problems['frecuencia_cardiaca'] = $problems['frecuencia_cardiaca'] + 1;
            }
            if ($sv->frecuencia_respiratoria < 12 || $sv->frecuencia_respiratoria > 20) {
                $problems['frecuencia_respiratoria'] = $problems['frecuencia_respiratoria'] + 1;
            }
            if ($sv->presion_sistolica < 110 || $sv->presion_sistolica > 140) {
                $problems['presion_sistolica'] = $problems['presion_sistolica'] + 1;
            }
            if ($sv->presion_diastolica < 70 || $sv->presion_diastolica > 90) {
                $problems['presion_diastolica'] = $problems['presion_diastolica'] + 1;
            }
            if ($sv->temperatura < 36.00 || $sv->temperatura > 37.2){
                $problems['temperatura'] = $problems['temperatura'] + 1;
            }
        }
        $datos = array(
            "fc" => $fc,
            "fr" => $fr,
            "ps" => $ps,
            "pd" => $pd,
            "tm" => $tm,
        );
        return view(
            'signos_vitales', 
            [
                'persona' => $persona,
                'personas' => $personas,
                'problems' => $problems,
                'datos' => $datos
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $p = Persona::find($id);
        $p->nombre = $request->nombre;
        $p->apellido = $request->apellido;
        $p->identificacion = $request->identificacion;
        $p->fecha_nacimiento = $request->fecha_nacimiento;
        $p->sexo = $request->sexo;
        $p->diagnostico = $request->diagnostico;
        $p->prescripcion_medica = $request->prescripcion_medica;
        $p->observacion = $request->observacion;
        $p->save();

        return redirect()->route('personas')->with('success', 'Persona actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
