<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminAuthController extends BaseController
{
    public function login()
    {
        // Pastikan kamu punya view auth/admin_login
        return view('auth/admin_login');
    }

public function processLogin()
{
    $session = session();
    $model = new \App\Models\UserModel(); // Panggil model user

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // --- INI BAGIAN YANG TADI HILANG ---
    // Cari user di database berdasarkan email yang diinput
    $user = $model->where('email', $email)->first();
    // ----------------------------------

    // Sekarang variabel $user sudah ada, baru bisa dicek di baris ini
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

        // Sesuai permintaanmu, langsung lempar ke form tambah pegawai
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
