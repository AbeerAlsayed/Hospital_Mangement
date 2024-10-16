<?php

namespace Modules\Departments\Services;

use Modules\Departments\Models\Department;

class DepartmentService
{
    public function create(array $data)
    {
        return Department::create($data);
    }

    public function update($id, array $data)
    {
        $department = Department::findOrFail($id);
        $department->update($data);
        return $department;
    }

    public function delete($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
    }
}
