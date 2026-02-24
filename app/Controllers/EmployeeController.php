<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\PositionModel;

class EmployeeController extends BaseController
{
    protected $employeeModel;
    protected $departmentModel;
    protected $positionModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->positionModel = new PositionModel();
    }

    public function index()
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id');

        
        $query = $this->employeeModel
            ->select('employees.*, users.name as user_name, departments.department_name, positions.position_name')
            ->join('users', 'users.id = employees.user_id')
            ->join('departments', 'departments.id = employees.department_id')
            ->join('positions', 'positions.id = employees.position_id');

        if ($role === 'admin') {
            
            $data['employees'] = $query->findAll();
        } else {
            
            $data['employees'] = $query->where('employees.user_id', $userId)->findAll();
        }

        return view('employees/index', $data);
    }

public function new()
{
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/employees')->with('error', 'Akses ditolak.');
    }

    $userModel = new \App\Models\UserModel();
    
    $data['departments'] = $this->departmentModel->findAll();
    
    $data['users'] = $userModel->where('role', 'pegawai')->findAll(); 
    $data['positions'] = [];
    
    return view('employees/create', $data);
}

public function create()
{
    $userModel = new \App\Models\UserModel(); 

    
    $rules = [
        'name'          => 'required',
        'nip'           => 'required|is_unique[employees.nip]',
        'department_id' => 'required',
        'position_id'   => 'required',
        'gender'        => 'required',
        'salary'        => 'required|numeric',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    
    $userData = [
        'name'     => $this->request->getPost('name'),
        'email'    => strtolower(str_replace(' ', '', $this->request->getPost('name'))) . '@mail.com', 
        'password' => password_hash('12345', PASSWORD_DEFAULT), 
        'role'     => 'pegawai'
    ];
    
    $userModel->insert($userData);
    $newUserId = $userModel->insertID(); 

    
    $photo = 'default.png';
    $file = $this->request->getFile('photo');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/photos', $newName);
        $photo = $newName;
    }

    
    $employeeData = [
        'user_id'       => $newUserId, 
        'department_id' => $this->request->getPost('department_id'),
        'position_id'   => $this->request->getPost('position_id'),
        'nip'           => $this->request->getPost('nip'),
        'gender'        => $this->request->getPost('gender'),
        'phone'         => $this->request->getPost('phone'),
        'address'       => $this->request->getPost('address'),
        'salary'        => $this->request->getPost('salary'),
        'photo'         => $photo,
    ];

    if ($this->employeeModel->save($employeeData)) {
        return redirect()->to('/employees')->with('success', 'Data Pegawai & Akun User berhasil dibuat!');
    }
}

    public function edit($id)
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id');

        $employee = $this->employeeModel
            ->select('employees.*, users.name')
            ->join('users', 'users.id = employees.user_id')
            ->find($id);

        
        if ($role !== 'admin' && $employee['user_id'] != $userId) {
            return redirect()->to('/employees')->with('error', 'Anda tidak punya akses.');
        }

        $data['employee'] = $employee;
        $data['departments'] = $this->departmentModel->findAll();
        $data['positions'] = $this->positionModel
            ->where('department_id', $employee['department_id'])
            ->findAll();

        return view('employees/edit', $data);
    }

    public function update($id)
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id');

        $employee = $this->employeeModel->find($id);

        
        if ($role !== 'admin' && $employee['user_id'] != $userId) {
            return redirect()->to('/employees')->with('error', 'Anda tidak punya akses.');
        }

        $rules = [
            'user_id'       => 'required',
            'nip'           => 'required|is_unique[employees.nip]',
            'department_id' => 'required',
            'position_id'   => 'required',
            'gender'        => 'required', 
            'phone'         => 'required', 
            'address'       => 'required', 
            'salary'        => 'required|numeric',
        ];


        $messages = [
            'nip' => [
                'required'  => 'NIP wajib diisi.',
                'is_unique' => 'NIP sudah digunakan.',
            ],
            'department_id' => ['required' => 'Departemen wajib dipilih.'],
            'position_id'   => ['required' => 'Jabatan wajib dipilih.'],
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
                ->select('employees.*, users.name')
                ->join('users', 'users.id = employees.user_id')
                ->find($id);
            $data['departments'] = $this->departmentModel->findAll();
            $data['positions'] = $this->positionModel
                ->where('department_id', $data['employee']['department_id'])
                ->findAll();
            $data['errors'] = $this->validator->getErrors();
            return view('employees/edit', $data);
        }

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'nip'           => $this->request->getPost('nip'),
            'name'          => $this->request->getPost('name'),
            'department_id' => $this->request->getPost('department_id'),
            'position_id'   => $this->request->getPost('position_id'),
            'salary'        => $this->request->getPost('salary'),
        ];

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/photos', $newName);
            $data['photo'] = $newName;
        }

        $this->employeeModel->update($id, $data);
        return redirect()->to('/employees');
    }

    public function delete($id)
    {
        // Double check role
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/employees')->with('error', 'Anda tidak punya akses.');
        }

        $this->employeeModel->delete($id);
        return redirect()->to('/employees');
    }

public function getPositionsByDepartment($department_id)
{
    $positions = $this->positionModel
        ->where('department_id', $department_id)
        ->findAll();

    return $this->response->setJSON($positions);
}
}