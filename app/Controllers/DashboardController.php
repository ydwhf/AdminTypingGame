<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'active' => 'dashboard'
        ];
        return view('Dashboard/index', $data);
    }
}
