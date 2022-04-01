<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use LDAP\Result;
use App\Models\Customer;

class OrderController extends Controller
{
    public function index(Request $request) {
        
        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();
        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();

        return view('orders.index', compact('orders', 'total', 'receivedAmount'));
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->quantity,
                'product_id' => $item->id,
                'status' => $item->status,
            ]);
            
            if ($item->quantity - $item->pivot->quantity < 0){
                return redirect()->back()->with('alert','Only '.$item->quantity.'left!');
            }
            else{
                $item->quantity = $item->quantity - $item->pivot->quantity;
                if ($item->quantity == 0){ $item->status = 0; }; 
                $item->save();
            }
            
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);

        $data=Customer::find($request->user()->id);
        $rem=($data->balance);
        $total=$rem - $request->amount;
        $data->balance=$total;
        $data->save();

        
        return 'success';
    }
}
