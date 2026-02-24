<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminAuthController extends BaseController
{
    public function login()
    {
        
        return view('auth/admin_login');
    }

public function processLogin()
{
    $session = session();
    $model = new \App\Models\UserModel(); 

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

   
    $user = $model->where('email', $email)->first();

    
    if ($user && password_verify($password, $user['password'])) {
        
        // Cek role apakah admin
        if ($user['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Hanya Admin yang bisa masuk!');
        }

        $session->set([
            'user_id'    => $user['id'],
            'name'       => $user['name'],
            'role'       => $user['role'],
            'isLoggedIn' => true
        ]);

        
        return redirect()->to (base_url('/employees'));
    }

    return redirect()->back()->with('error', 'Email atau password Admin salah.');
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
