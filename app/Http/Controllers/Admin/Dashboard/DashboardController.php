<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function index()
    {

        return view('vendor.backpack.base.dashboard');
    }
   
}
