<?php

namespace App\Http\Controllers\Admin;

use App\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{

    private function performValidation($request)
    {

        $rules = [
            'name' => 'required|min:3'
        ];
        $messages = [
            'name' => 'es necesario ingresar un nombre',
            'name' => 'como minimo el nombre debe tener 3 caracteres',
        ];
        $this->validate($request, $rules, $messages);
    }

    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function store(Request $request)
    {
        $this->performValidation($request);

        $specialty  = new Specialty();
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save();

        $notification = 'La especialidad se ha registrado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }

    public function edit(Specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $this->performValidation($request);

        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save();

        $notification = 'La especialidad se ha modificado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty)
    {

        $specialty->delete();
        $notification = 'La especialidad ' . $specialty->name . ' se ha eliminado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }
}
