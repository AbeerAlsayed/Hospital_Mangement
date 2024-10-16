<?php
namespace Modules\Appointments\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Appointments\Models\Appointment;

class AppointmentService
{
    public function createAppointment(array $data)
    {
        try {
            return Appointment::create($data);
        } catch (Exception $e) {
            Log::error('Error creating appointment: ' . $e->getMessage());
            throw new Exception('Error creating appointment.');
        }
    }

    public function getAppointment(int $id)
    {
        try {
            return Appointment::with(['patient', 'doctor'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Appointment not found.');
        }
    }

    public function updateAppointment(array $data, int $id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->update($data);
            return $appointment;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Appointment not found.');
        }
    }

    public function deleteAppointment(int $id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Appointment not found.');
        }
    }

    public function getAllAppointmentsPaginated($perPage = 10)
    {
        return Appointment::with(['patient', 'doctor'])->paginate($perPage);
    }
}
