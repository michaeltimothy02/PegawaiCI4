<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EmployeeModel;

class EmployeeApi extends ResourceController
{
    protected $modelName = 'App\Models\EmployeeModel';
    protected $format    = 'json';

    // GET: api/employees
    public function index()
    {
        $data = $this->model
            ->select('employees.*, users.name as user_name, departments.department_name, positions.position_name')
            ->join('users', 'users.id = employees.user_id', 'left')
            ->join('departments', 'departments.id = employees.department_id', 'left')
            ->join('positions', 'positions.id = employees.position_id', 'left')
            ->findAll();

        return $this->respond($data);
    }

    // GET: api/employees/1
    public function show($id = null)
    {
        $data = $this->model
            ->select('employees.*, users.name as user_name, departments.department_name, positions.position_name')
            ->join('users', 'users.id = employees.user_id', 'left')
            ->join('departments', 'departments.id = employees.department_id', 'left')
            ->join('positions', 'positions.id = employees.position_id', 'left')
            ->find($id);

        if (!$data) {
            return $this->failNotFound('Data employee tidak ditemukan');
        }

        return $this->respond($data);
    }

    // POST: api/employees
    public function create()
    {
        $rules = [
            'nip'           => 'required|is_unique[employees.nip]',
            'department_id' => 'required',
            'position_id'   => 'required',
            'salary'        => 'required|numeric',
            'photo'         => 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        // Handle file upload
        $photo = null;
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/photos', $newName);
            $photo = $newName;
        }

        $this->model->save([
            'nip'           => $this->request->getVar('nip'),
            'user_id'       => session()->get('user_id'), // dari session login
            'department_id' => $this->request->getVar('department_id'),
            'position_id'   => $this->request->getVar('position_id'),
            'salary'        => $this->request->getVar('salary'),
            'photo'         => $photo
        ]);

        return $this->respondCreated([
            'message' => 'Employee berhasil ditambahkan'
        ]);
    }

    // PUT: api/employees/1
    public function update($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Data employee tidak ditemukan');
        }

        $rules = [
            'nip'           => "required|is_unique[employees.nip,id,{$id}]",
            'department_id' => 'required',
            'position_id'   => 'required',
            'salary'        => 'required|numeric',
            'photo'         => 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $updateData = [
            'nip'           => $this->request->getVar('nip'),
            'department_id' => $this->request->getVar('department_id'),
            'position_id'   => $this->request->getVar('position_id'),
            'salary'        => $this->request->getVar('salary')
        ];

        // Handle file upload
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus foto lama
            if ($data['photo'] && file_exists(ROOTPATH . 'public/uploads/photos/' . $data['photo'])) {
                unlink(ROOTPATH . 'public/uploads/photos/' . $data['photo']);
            }
            
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/photos', $newName);
            $updateData['photo'] = $newName;
        }

        $this->model->update($id, $updateData);

        return $this->respond([
            'message' => 'Employee berhasil diupdate'
        ]);
    }

    // DELETE: api/employees/1
    public function delete($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Data employee tidak ditemukan');
        }

        // Hapus foto jika ada
        if ($data['photo'] && file_exists(ROOTPATH . 'public/uploads/photos/' . $data['photo'])) {
            unlink(ROOTPATH . 'public/uploads/photos/' . $data['photo']);
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'message' => 'Employee berhasil dihapus'
        ]);
    }

    // Optional: Endpoint untuk mendapatkan positions berdasarkan department
    // GET: api/positions-by-department/1
    public function getPositionsByDepartment($department_id)
    {
        $positionModel = new \App\Models\PositionModel();
        $data = $positionModel->where('department_id', $department_id)->findAll();

        return $this->respond($data);
    }
}