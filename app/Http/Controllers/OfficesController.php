<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficesController extends Controller
{
//    READING
    public function index(){
        return Office::all();
    }

    public function show($id){
        return Office::findOrFail($id);
    }

//    CREATING
    public function store(Request $request){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        $office = $request->validate([
            'city' =>'required',
            'phone' =>'required',
            'address1' => 'required',
            'address2' => 'required',
            'state' =>'required',
            'country' => 'required',
            'postal_code' => 'required',
            'territory' =>'required'
        ]);
        Office::create($office);
        return Office::all();
    }
//    UPDATING
    public function update(Office $office, Request $request){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        $office->update($request->json()->all());
        return Office::all();
    }

//    DELETING
    public function destroy(Office $office){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        try {
            $office->delete();
            return Office::all();
        } catch (\Exception $e){
            dd($e);
        }
    }
}
