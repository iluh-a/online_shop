<?php

namespace App\Http\Controllers;

use App\Models\ProductLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductLinesController extends Controller
{

//    READING
    public function index(){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        return ProductLine::all();
    }

    public function show($id){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        return ProductLine::findOrFail($id);
    }

//    CREATING
    public function store(Request $request){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        $product_line = $request->validate([
            'desc_in_text' => 'required',
            'desc_in_html' =>'required',
            'image' => 'required'
        ]);
        ProductLine::create($product_line);
        return ProductLine::all();
    }
//    UPDATING
    public function update(ProductLine $ProductLine, Request $request){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        $ProductLine->update($request->json()->all());
        return ProductLine::all();
    }

//    DELETING
    public function destroy(ProductLine $ProductLine){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        try {
            $ProductLine->delete();
            return ProductLine::all();
        } catch (\Exception $e){
            dd($e);
        }
    }
}
