<?php

namespace App\Http\Controllers\Admin;

use App\Patient;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{

    private function performValidation($request)
    {

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',

        ];
        $messages = [
            'name' => 'es necesario ingresar un nombre',
            'name' => 'como minimo el nombre debe tener 3 caracteres',
        ];
        $this->validate($request, $rules, $messages);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::patients()->paginate(15);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->performValidation($request);

        User::create(
            $request->only('name', 'email', 'dni', 'address', 'phone') +
                [
                    'role' => 'patient',
                    'password' => bcrypt($request->input('password')),
                ]
        );

        $notification = 'El Paciente se ha registrado correctamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = User::patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->performValidation($request);

        $user = User::patients()->findOrFail($id);

        $data = $request->only('name', 'email', 'dni', 'address', 'phone');

        $password = $request->input('password');

        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notification = 'El Paciente se ha modificado correctamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patient->delete();
        $notification = 'El Paciente ' . $patient->name . ' se ha eliminado correctamente.';
        return redirect('/patients')->with(compact('notification'));
    }
}
