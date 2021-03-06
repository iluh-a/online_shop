<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

//    READING
    public function index(){
        if(auth()->user()->tokenCan('customer-access')) {  // if u are customer
            $customer = Customer::find(auth()->user()->id);
            return $customer->orders;     // return this customers orders

        } elseif (auth()->user()->tokenCan('employee-access')){ // if u are employee
            Order::paginate(5);                             // return all orders
        }
        abort(403, 'unauthorized');
    }

    public function show(Order $order){
//        if u are  this orders customers employee
        if(auth()->user()->tokenCan('employee-access') && auth()->user()->id == $order->customer->employee->id) {
            return $order->with('products');    // return order with its products

//            OR u are the customer of the order
        } elseif (auth()->user()->id == $order->customer_id) {
            return $order->with('products');    // return order with its products
        }
        abort(403, 'unauthorized');
    }

//    CREATING
    public function store(Request $request){
        if(auth()->user()->tokenCan('employee-access')) { // only customers
            abort(403, 'unauthorized');
        }
        $attributes = $request->validate([
            'customer_id' => 'required',
            'order_date' => 'required|date',
            'required_date' => 'required|date',
            'status' => 'required',
            'comments' => 'required'
        ]);

        $order = Order::create($attributes);
        $order->products()->attach($request->products);

        return Order::all();
    }
//    UPDATING
    public function update(Order $order, Request $request){
        if(auth()->user()->tokenCan('customer-access') && $order->customer_id == auth()->user()->id) { // if this order is yours
            $order->update($request->json()->all());

            if ($request->status == 3){
                $order->update(["shipped_date" => now()]);
            }
            return Order::all();
        }
        abort(403, 'unauthorized');

    }

//    DELETING
    public function destroy(Order $Order){
        if(auth()->user()->tokenCan('customer-access') && $Order->customer_id == auth()->user()->id) { // if this order is yours
            try {
                $Order->delete();
                return Order::all();
            } catch (\Exception $e){
                dd($e);
            }
        }
        abort(403, 'unauthorized');
    }
}
