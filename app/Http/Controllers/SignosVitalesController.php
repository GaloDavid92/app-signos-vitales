<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\SignosVitales;
use Illuminate\Http\Request;

class SignosVitalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::all();
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
        $request->validate([
            'presion' => 'required|regex:/(^\d+(\/\d+)*$)/u'
        ]);
        $sv = new SignosVitales();
        $sv->id_persona = $request->id_persona;
        $sv->frecuencia_cardiaca = $request->frecuencia_cardiaca;
        $sv->frecuencia_respiratoria = $request->frecuencia_respiratoria;
        $sv->presion_sistolica = explode("/",$request->presion)[0];
        $sv->presion_diastolica = explode("/",$request->presion)[1];
        $sv->temperatura = $request->temperatura;
        $sv->id_usuario = auth()->user()->id;
        $sv->save();
        return redirect()->route('signos_vitales', $request->id_persona)->with('success', 'Registro guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $signosVitales = SignosVitales::find($id);
        $id_persona = $signosVitales->id_persona;
        $signosVitales->delete();
        return redirect()->route('signos_vitales', $id_persona)->with('success', 'Registro eliminada');
    }
}