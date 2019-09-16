<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'user' => auth()->user(),
        ]);
    }
}
