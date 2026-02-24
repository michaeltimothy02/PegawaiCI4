<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\PositionModel;

class ProfileController extends BaseController
{
    protected $employeeModel;
    protected $userModel;
    protected $departmentModel;
    protected $positionModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->userModel = new UserModel();
        $this->departmentModel = new DepartmentModel();
        $this->positionModel = new PositionModel();
    }

    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        // TAMBAHKAN JOIN ke departments dan positions di sini
        $employee = $this->employeeModel
            ->select('employees.*, users.name, users.email, departments.department_name, positions.position_name') 
            ->join('users', 'users.id = employees.user_id')
            ->join('departments', 'departments.id = employees.department_id', 'left') // Join Departemen
            ->join('positions', 'positions.id = employees.position_id', 'left')       // Join Jabatan
            ->where('employees.user_id', $userId)
            ->first();

        if (!$employee) {
            return "Data profil belum diatur oleh Admin.";
        }

        $data['employee'] = $employee;
        return view('profile/index', $data);
    }

    public function edit()
    {
        $userId = session()->get('user_id');

        // TAMBAHKAN JOIN juga di sini agar nama departemen/jabatan muncul di halaman edit
        $data['employee'] = $this->employeeModel
            ->select('employees.*, users.name, users.email, departments.department_name, positions.position_name')
            ->join('users', 'users.id = employees.user_id')
            ->join('departments', 'departments.id = employees.department_id', 'left')
            ->join('positions', 'positions.id = employees.position_id', 'left')
            ->where('employees.user_id', $userId)
            ->first();

        $data['departments'] = $this->departmentModel->findAll();

        return view('profile/edit', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');

        $employee = $this->employeeModel
            ->where('user_id', $userId)
            ->first();

        // Karena kita sudah buat readonly di view sebelumnya, 
        // hapus 'nip', 'department_id', dan 'salary' dari validation rules 
        // agar tidak terjadi error jika input tersebut tidak dikirim/kosong.
        $rules = [
            'name'  => 'required',
            'photo' => 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, panggil ulang data dengan JOIN
            $data['employee'] = $this->employeeModel
                ->select('employees.*, users.name, users.email, departments.department_name, positions.position_name')
                ->join('users', 'users.id = employees.user_id')
                ->join('departments', 'departments.id = employees.department_id', 'left')
                ->join('positions', 'positions.id = employees.position_id', 'left')
                ->where('employees.user_id', $userId)
                ->first();
            $data['errors'] = $this->validator->getErrors();
            return view('profile/edit', $data);
        }

        // Hanya update data yang boleh diubah pegawai (Nama & Foto)
        $dataUpdate = [];
        
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/photos', $newName);
            $dataUpdate['photo'] = $newName;
        }

        if(!empty($dataUpdate)) {
            $this->employeeModel->update($employee['id'], $dataUpdate);
        }

        // Update nama di tabel users
        $this->userModel->update($userId, [
            'name' => $this->request->getPost('name')
        ]);

        session()->set('name', $this->request->getPost('name'));

        return redirect()->to('/profile')->with('success', 'Profil berhasil diupdate!');
    }
}