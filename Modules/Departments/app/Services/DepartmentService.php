<?php

namespace Modules\Departments\Services;

use Modules\Departments\Models\Department;

class DepartmentService
{
    public function create(array $data)
    {
        return Department::create($data);
    }

    public function update(Department $department, array $data)
    {
        $department->update($data);
        return $department;
    }

    public function delete(Department $department)
    {
        $department->delete();
    }
}
