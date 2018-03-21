<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Chỉ cho phép user có role là employee hoặc manage truy cập action này
        Auth::user()->authorizeRoles(['employee', 'manager']);

        // User đã vượt qua kiểm tra role, kết xuất view cho chức năng tương ứng với action
        return view('home');
    }

    public function admin()
    {
        Auth::user()->authorizeRoles(['manager']);

        return view('admin');
    }
}
