<?php

namespace Modules\Users\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Users\Models\Doctor;

class DoctorService
{
    public function createDoctor(array $data)
    {
        try {
            return Doctor::create($data);
        } catch (Exception $e) {
            throw new Exception('Error creating doctor.');
        }
    }

    public function getDoctor(int $id)
    {
        try {
            return Doctor::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Doctor not found.');
        }
    }

    public function getAllDoctors()
    {
        return Doctor::all();
    }

    public function updateDoctor(array $data, int $id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->update(array_filter($data));
            return $doctor;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Doctor not found.');
        }
    }

    public function deleteDoctor(int $id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Doctor not found.');
        }
    }
}
