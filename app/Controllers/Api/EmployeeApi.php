<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeeModel;

class EmployeeApi extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\EmployeeModel';
    protected $format    = 'json';

    /**
     * GET: api/employees
     * Mengambil semua data pegawai
     */
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    /**
     * GET: api/employees/(:num)
     * Mengambil satu data pegawai berdasarkan ID
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Data pegawai tidak ditemukan untuk ID ' . $id);
        }

        return $this->respond($data, 200);
    }

    /**
     * POST: api/employees
     * Menambah data pegawai baru
     */
    public function create()
    {
        $rules = [
            'user_id'       => 'required|is_numeric',
            'nip'           => 'required|is_unique[employees.nip]',
            'department_id' => 'required|is_numeric',
            'position_id'   => 'required|is_numeric',
            'salary'        => 'required|decimal',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $payload = [
            'user_id'       => $this->request->getVar('user_id'),
            'nip'           => $this->request->getVar('nip'),
            'department_id' => $this->request->getVar('department_id'),
            'position_id'   => $this->request->getVar('position_id'),
            'salary'        => $this->request->getVar('salary'),
        ];

        if ($this->model->insert($payload)) {
            return $this->respondCreated([
                'status'  => 201,
                'message' => 'Data pegawai berhasil ditambahkan',
                'data'    => $payload
            ]);
        }

        return $this->fail('Gagal menyimpan data pegawai.');
    }

    /**
     * PUT: api/employees/(:num)
     * Mengupdate data pegawai
     */
    public function update($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $input = $this->request->getRawInput(); // Untuk menangkap data dari Body PUT
        
        $payload = [
            'user_id'       => $input['user_id'] ?? $data['user_id'],
            'nip'           => $input['nip'] ?? $data['nip'],
            'department_id' => $input['department_id'] ?? $data['department_id'],
            'position_id'   => $input['position_id'] ?? $data['position_id'],
            'salary'        => $input['salary'] ?? $data['salary'],
        ];

        if ($this->model->update($id, $payload)) {
            return $this->respond([
                'status'  => 200,
                'message' => 'Data pegawai berhasil diperbarui'
            ]);
        }

        return $this->fail('Gagal memperbarui data.');
    }

    /**
     * DELETE: api/employees/(:num)
     * Menghapus data pegawai
     */
    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                'status'  => 200,
                'message' => 'Data pegawai berhasil dihapus'
            ]);
        }

        return $this->fail('Gagal menghapus data.');
    }

    /**
     * Custom Method: GET api/positions-by-department/(:num)
     */
    public function getPositionsByDepartment($departmentId = null)
    {
        // Contoh logika jika ingin mengambil posisi berdasarkan departemen
        // Pastikan Anda punya model PositionModel atau query custom
        $db = \Config\Database::connect();
        $builder = $db->table('positions');
        $positions = $builder->where('department_id', $departmentId)->get()->getResult();

        return $this->respond($positions);
    }
}