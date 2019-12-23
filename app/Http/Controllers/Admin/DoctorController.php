<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Specialty;

class DoctorController extends Controller
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
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
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

        $user = User::create(
            $request->only('name', 'email', 'dni', 'address', 'phone') +
                [
                    'role' => 'doctor',
                    'password' => bcrypt($request->input('password')),
                ]
        );
        $user->specialties()->attach($request->input('specialties'));

        $notification = 'El doctor se ha registrado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialties = Specialty::all();
        $doctor = User::doctors()->findOrFail($id);
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->performValidation($request);

        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name', 'email', 'dni', 'address', 'phone');

        $password = $request->input('password');

        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $user->specialties()->sync($request->input('specialties'));

        $notification = 'El doctor se ha modificado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        $doctor->delete();
        $notification = 'El doctor ' . $doctor->name . ' se ha eliminado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }
}
