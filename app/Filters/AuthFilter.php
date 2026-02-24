<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek apakah user sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek Role (Hanya jika route tersebut meminta role spesifik)
        // Ini untuk mencegah error "Argument #2 must be of type array"
        if (!empty($arguments)) {
            $role = session()->get('role');
            if (!in_array($role, $arguments)) {
                
                // Jika dia Admin tapi nyasar ke area Pegawai atau sebaliknya
                // Lempar ke halaman sesuai rolenya agar tidak looping
                $redirectTarget = ($role === 'admin') ? 'employees/new' : 'dashboard';
                
                return redirect()->to(base_url($redirectTarget))->with('error', 'Akses Ditolak.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Biasanya kosong
    }
}
