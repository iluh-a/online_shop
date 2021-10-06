<?php


namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{

    public function __construct()
    {
        $this->middleware['auth']->only();
    }

//    READING
    public function index(){
        if(!auth()->user()->tokenCan('customer-access')) {   // if u are an customer
            abort(403, 'unauthorized');
        }
        return Payment::all();
    }

    public function show($id){
        if(!auth()->user()->tokenCan('customer-access')) {   // if u are an customer
            abort(403, 'unauthorized');
        }
        return Payment::findOrFail($id);
    }

//    CREATING
    public function store(Request $request){
        if(!auth()->user()->tokenCan('customer-access')) {   // if u are an customer
            abort(403, 'unauthorized');
        }
        $payment = $request->validate([
            'customer_id' => 'required',
            'payment_date' => 'required',
            'amount' => 'required'
        ]);
        Payment::create($payment);
        return Payment::all();
    }
//    UPDATING
    public function update(Payment $Payment, Request $request){
        if(auth()->user()->tokenCan('customer-access') && $Payment->id == auth()->user()->id) {   // if this is ur payment
            $Payment->update($request->json()->all());
            return Payment::all();
        }
        abort(403, 'unauthorized');
    }

//    DELETING
    public function destroy(Payment $Payment){
        if(auth()->user()->tokenCan('customer-access') && $Payment->id == auth()->user()->id) {   // if this is ur payment
            try {
                $Payment->delete();
                return Payment::all();

            } catch (\Exception $e) {
                dd($e);
            }
        }
        abort(403, "unauthorized");
    }
}
