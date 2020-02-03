<?php

namespace App\Console\Commands;

use App\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\This;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fcm:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar Mensajes via FCM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();
        $headers = ['id', 'scheduled_date', 'scheduled_time', 'patient_id'];
        $this->info('Buscando Citas:');

        $appointmentsTomorrow = $this->getAppointments24Hours($now->copy());

        foreach ($appointmentsTomorrow as $appointment) {
            $appointment->patient->sendFCM('No Olvides tu Cita para mañana  a esta hora');
            $this->info('Mensaje enviado 24 Horas antes al paciente (ID):' . $appointment->patient_id);
        }
        $this->table($headers, $appointmentsTomorrow);
        $appointmentsNextHour = $this->getAppointmentsNextHour($now->copy());

        foreach ($appointmentsNextHour as $appointment) {
            $appointment->patient->sendFCM('Tienes una cita en 1 Hora. Te Esperamos');
            $this->info('Mensaje enviado 1 hora antes al paciente (ID):' . $appointment->patient_id);
        }
        $this->table($headers, $appointmentsNextHour);
    }

    private function getAppointments24Hours($now)
    {

        return  Appointment::where('status', 'Confirmada')
            ->where('scheduled_date', $now->addDay()->toDateString())
            ->where('scheduled_time', '>=', $now->copy()->subMinutes(3)->toTimeString())
            ->where('scheduled_time', '<', $now->copy()->addMinutes(2)->toTimeString())
            ->get(['id', 'scheduled_date', 'scheduled_time', 'patient_id'])->toArray();
    }

    private function getAppointmentsNextHour($now)
    {

        return  Appointment::where('status', 'Confirmada')
            ->where('scheduled_date', $now->addHour()->toDateString())
            ->where('scheduled_time', '>=', $now->copy()->subMinutes(3)->toTimeString())
            ->where('scheduled_time', '<', $now->copy()->addMinutes(2)->toTimeString())
            ->get(['id', 'scheduled_date', 'scheduled_time', 'patient_id'])->toArray();
    }
}
