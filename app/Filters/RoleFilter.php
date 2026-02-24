<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek apakah sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // 2. Ambil role yang dibutuhkan dari parameter routes (admin)
        $allowedRole = $arguments[0];

        // 3. Cek apakah role user sesuai
        if (session()->get('role') !== $allowedRole) {
            // Kalau bukan admin tapi maksa masuk, lempar ke profile
            return redirect()->to('/profile')->with('error', 'Akses Ditolak! Anda bukan ' . $allowedRole);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 
    }
}