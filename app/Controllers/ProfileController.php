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

    // Lakukan JOIN agar data 'name' dan 'email' dari tabel users bisa terbaca
    $employee = $this->employeeModel
        ->select('employees.*, users.name, users.email') // Ambil name dan email dari users
        ->join('users', 'users.id = employees.user_id')
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

        $data['employee'] = $this->employeeModel
            ->select('employees.*, users.name, users.email')
            ->join('users', 'users.id = employees.user_id')
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

        $rules = [
            'nip'           => "required|is_unique[employees.nip,id,{$employee['id']}]",
            'department_id' => 'required',
            'salary'        => 'required|numeric',
            'photo'         => 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
        ];

        $messages = [
            'nip' => [
                'required'  => 'NIP wajib diisi.',
                'is_unique' => 'NIP sudah digunakan.',
            ],
            'department_id' => ['required' => 'Departemen wajib dipilih.'],
            'salary' => [
                'required' => 'Gaji wajib diisi.',
                'numeric'  => 'Gaji harus berupa angka.',
            ],
            'photo' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in'  => 'Format foto harus JPG atau PNG.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            $data['employee'] = $this->employeeModel
                ->select('employees.*, users.name, users.email')
                ->join('users', 'users.id = employees.user_id')
                ->where('employees.user_id', $userId)
                ->first();
            $data['departments'] = $this->departmentModel->findAll();
            $data['errors'] = $this->validator->getErrors();
            return view('profile/edit', $data);
        }

        $dataUpdate = [
            'nip'           => $this->request->getPost('nip'),
            'department_id' => $this->request->getPost('department_id'),
            'salary'        => $this->request->getPost('salary'),
        ];

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/photos', $newName);
            $dataUpdate['photo'] = $newName;
        }

        $this->employeeModel->update($employee['id'], $dataUpdate);

        // Update nama di tabel users
        $this->userModel->update($userId, [
            'name' => $this->request->getPost('name')
        ]);

        // Update session name
        session()->set('name', $this->request->getPost('name'));

        return redirect()->to('/profile')->with('success', 'Profil berhasil diupdate!');
    }
}