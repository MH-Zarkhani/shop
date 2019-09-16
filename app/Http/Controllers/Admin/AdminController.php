<?php

namespace App\Http\Controllers\Admin;


class AdminController extends BaseAdminController
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'user' => auth()->user(),
        ]);
    }
}
