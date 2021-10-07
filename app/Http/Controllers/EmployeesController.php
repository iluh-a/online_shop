<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{

//    READING
    public function index(){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        return Employee::all();
    }

    public function show($id){
        if(auth()->user()->tokenCan('employee-access') || Customer::findOrFail(auth()->user()->id)->employee()->id == $id) {   // FOR CUSTOMER: if this employee is yours OR if u are an employee
            return Employee::findOrFail($id);
        }
        abort(403, 'unauthorized');
    }

//    CREATING
    public function store(Request $request){
        if(auth()->user()->tokenCan('customer-access')) {   //  if u are an employee
            abort(403, 'unauthorized');
        }
        $employee = $request->validate([
            'office_code' => 'required',
            'reports_to' =>'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'extension' => 'required',
            'email' =>'required',
            'job_title' => 'required'
        ]);
        Employee::create($employee);
        return Employee::all();
    }
//    UPDATING
    public function update(Employee $Employee, Request $request){
        if(auth()->user()->tokenCan('employee-access')) {
            $Employee->update($request->json()->all());
            return Employee::all();
        }
        abort(403, 'unauthorized');
    }

//    DELETING
    public function destroy(Employee $Employee){
        if(auth()->user()->tokenCan('employee-access')) {
            try {
                $Employee->delete();
                return Employee::all();
            } catch (\Exception $e){
                dd($e);
            }
        }
        abort(403, 'unauthorized');
    }
}
