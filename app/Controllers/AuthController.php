<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new \App\Models\UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {

            $session->set([
                'user_id' => $user['id'],
                'name'    => $user['name'],
                'role'    => $user['role'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}