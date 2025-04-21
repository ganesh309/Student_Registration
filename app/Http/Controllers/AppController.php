<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students_table;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function index()
    {
            return view("welcome");






    }
    public function about()
    {
        return view("about");
    }
}

