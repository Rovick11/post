<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    //
    public function load($id)
    {
        $data=Customer::find($id);
        return view('load',['data'=>$data]);
    }
    public function update(Request $req)
    {
        $data=Customer::find($req->id);

        $rem=($req->balance);
        $dep=$req->bal;

        $total=$dep+$rem;

        $data->balance=$total;
        $data->save();
        return redirect('admin/customers');
    }
}
