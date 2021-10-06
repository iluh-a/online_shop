<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

//    READING

    public function index(){
        if(!auth()->user()->tokenCan('employee-access')) {  // if u are an employee
            abort(403, 'unauthorized');
        }
        return Customer::with("orders")->paginate(10);
    }

    public function show($id){
        if(auth()->user()->tokenCan('employee-access') || auth()->user()->id == $id) { // if u are an empl OR u r the customer
            return Customer::findOrFail($id)->load('orders');
        }
        abort(403, 'unauthorized');

    }

//    CREATING
    public function store(Request $request){
        if(!auth()->user()->tokenCan('customer-access')) { // only for customers
            abort(403, 'unauthorized');
        }
        $customer = $request->validate([
            'sales_rep_employee_num' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'phone' => 'required',
            'address1' => 'required',
            'address2' =>'required',
            'city' =>'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'credit_limit' => 'required'
        ]);
        Customer::create($customer);
        return Customer::all();
    }
//    UPDATING

    public function update(Customer $customer, Request $request){                   // if u are the customer
        if(auth()->user()->tokenCan('customer-access') && auth()->user()->id == $customer->id) {
            $customer->update($request->json()->all());

            return Customer::all();
        }
        abort(403, 'unauthorized');
    }

//    DELETING
    public function destroy(Customer $customer){
        if(auth()->user()->tokenCan('customer-access') && auth()->user()->id == $customer->id) { // if u r the customer
            try {
                $customer->delete();
                return Customer::all();
            } catch (\Exception $e){
                dd($e);
            }
        }
        abort(403, 'unauthorized');
    }


}
