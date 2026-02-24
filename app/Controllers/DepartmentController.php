<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;

class DepartmentController extends BaseController
{
    protected $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        $data['departments'] = $this->departmentModel->findAll();
        return view('departments/index', $data);
    }

    public function new()
    {
        return view('departments/create');
    }

    public function create()
    {
        // dd($this->request->getPost()); 

        $this->departmentModel->save([
            'department_name' => $this->request->getPost('department_name')
        ]);

        return redirect()->to('/departments');
    }

public function edit($id = null)
{
    $model = new \App\Models\DepartmentModel();
    $data['department'] = $model->find($id);

    if (!$data['department']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('departments/edit', $data);
}

public function update($id = null)
{
    $model = new \App\Models\DepartmentModel();
    
    
    $data = [
        'department_name' => $this->request->getPost('department_name'),
    ];

    $model->update($id, $data);
    return redirect()->to('/departments')->with('success', 'Departemen berhasil diperbarui');
}

    public function delete($id)
    {
        $this->departmentModel->delete($id);
        return redirect()->to('/departments');
    }
}