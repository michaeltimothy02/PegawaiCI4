<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PositionModel;
use App\Models\DepartmentModel;

class PositionController extends BaseController
{
    protected $positionModel;
    protected $departmentModel;

    public function __construct()
    {
        $this->positionModel = new PositionModel();
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        $data['positions'] = $this->positionModel
            ->select('positions.*, departments.department_name')
            ->join('departments', 'departments.id = positions.department_id')
            ->findAll();

        return view('positions/index', $data);
    }

    public function new()
    {
        $data['departments'] = $this->departmentModel->findAll();
        return view('positions/create', $data);
    }

    public function create()
    {
        $this->positionModel->save([
            'position_name' => $this->request->getPost('position_name'),
            'department_id' => $this->request->getPost('department_id')
        ]);

        return redirect()->to('/positions');
    }

    public function edit($id)
    {
        $data['position'] = $this->positionModel->find($id);
        $data['departments'] = $this->departmentModel->findAll();

        return view('positions/edit', $data);
    }

    public function update($id)
    {
        $this->positionModel->update($id, [
            'position_name' => $this->request->getPost('position_name'),
            'department_id' => $this->request->getPost('department_id')
        ]);

        return redirect()->to('/positions');
    }

    public function delete($id)
    {
        $this->positionModel->delete($id);
        return redirect()->to('/positions');
    }
}