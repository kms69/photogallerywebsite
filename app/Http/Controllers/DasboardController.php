<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasboardController extends Controller
{

    public function adminpage()
    {
        return view('admin.main.index');
    }
}
