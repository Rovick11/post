<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class PayController extends Controller
{
    //
    public function index()
    {
        return view('pay');
    }
}
