<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\CancelledAppointment;
use App\Http\Requests\StoreAppointment;
use App\Specialty;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {

        $role = auth()->user()->role;
        if ($role == 'admin') {
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->paginate();
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->paginate();
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->paginate();
        } elseif ($role == 'doctor') {
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('doctor_id', auth()->id())
                ->paginate();
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('doctor_id', auth()->id())
                ->paginate();
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('doctor_id', auth()->id())
                ->paginate();
        } elseif ($role == 'patient') {
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('patient_id', auth()->id())
                ->paginate();
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('patient_id', auth()->id())
                ->paginate();
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('patient_id', auth()->id())
                ->paginate();
        }


        return view('appointments.index', compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments', 'role'));
    }

    public function show(Appointment $appointment)
    {
        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment', 'role'));
    }

    public function create(ScheduleServiceInterface $scheduleService)
    {
        $specialties = Specialty::all();

        $specialtyId = old('specialty_id');
        if ($specialtyId) {
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }

        $scheduleData = old('schedule_data');
        $doctorId = old('doctor_id');
        if ($scheduleData &&  $doctorId) {
            $intervals = $scheduleService->getAvailableIntervals($scheduleData, $doctorId);
        } else {
            $intervals = null;
        }

        return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }

    public function store(StoreAppointment $request)
    {

        $created = Appointment::createFormPatient($request, auth()->id());

        if ($created)
            $notification = 'La cita se registro correctamente';
        else
            $notification = 'Ocurrio un error al Registrar la Cita Medica';

        return back()->with(compact('notification'));
    }

    public function showCancelForm(Appointment $appointment)
    {
        $role = auth()->user()->role;
        if ($appointment->status == 'Confirmada')
            return view('appointments.cancel', compact('appointment'));

        return redirect('appointments', 'role');
    }

    public function postCancel(Appointment $appointment, Request $request)
    {
        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by = auth()->id();
            $appointment->cancellation()->save($cancellation);
        }
        $appointment->status = 'Cancelada';
        $saved =  $appointment->save();

        if ($saved)
            $appointment->patient->sendFCM("Su cita ha sido Cancelada.!");

        $notification = 'El cita se ha cancelado correctamente.';
        return redirect('appointments')->with(compact('notification'));
    }

    public function postConfirm(Appointment $appointment)
    {

        $appointment->status = 'Confirmada';
        $saved = $appointment->save();

        if ($saved)
            $appointment->patient->sendFCM("Su cita se ha Confirmado!");

        $notification = 'El cita se ha Confirmado correctamente.';
        return redirect('appointments')->with(compact('notification'));
    }
}
