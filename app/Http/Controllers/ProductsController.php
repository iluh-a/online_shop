<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

//    READING
    public function index(){
        return Product::all();
    }

    public function show($id){
        return Product::findOrFail($id);
    }

//    CREATING
    public function store(Request $request){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        $product = $request->validate([
            'product_line_id' => 'required',
            'name' =>'required',
            'scale' => 'required',
            'vendor' => 'required',
            'pdt_description' => 'required',
            'qty_in_stock' => 'required',
            'buy_price' => 'required',
            'msrp' =>'required'
        ]);
        Product::create($product);
        return Product::all();
    }
//    UPDATING
    public function update(Product $Product, Request $request){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        $Product->update($request->json()->all());
        return Product::all();
    }

//    DELETING
    public function destroy(Product $Product){
        if(!auth()->user()->tokenCan('employee-access')) {   // if u are an employee
            abort(403, 'unauthorized');
        }
        try {
            $Product->delete();
            return Product::all();
        } catch (\Exception $e){
            dd($e);
        }
    }
}
