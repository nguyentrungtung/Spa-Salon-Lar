<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function index()
    
        {
    
            $products = Product::all();
    
            return view('product.index',compact('products'));
    
        }
    
        public function create()
    
        {
    
            return view('product.create');
    
        }
    
       public function store(Request $request)
    
        {
    
            $product = new Product;
    
            $this->validate(request(), [
    
                'product_name' => 'required',
    
                'status' => 'required'
    
                
    
            ]);
    
            
    
            $product->product = $request->product_name;
    
            $product->status = $request->status;
    
            if($request->hasFile('product_image'))
    
            {
    
                //$filename = $request->profile_image->getClientOriginalName();
    
               $product->product_image = $request->product_image->store('images'); 
    
            }
    
           
    
            $product->save();
    
            return redirect('product')->with('success', 'Product has been created.');
    
        }
    
        public function delete($id)
    
        {
            $product = Product::find($id);
            $product->delete($id);
    
            return back()->with('success', 'Product has been deleted.');
    
        }
    
        public function edit($id)
    
        {
    
            $product = Product::find($id);
    
            return view('product.edit',compact('product'));
    
        }
    
       
    
       
    
        public function update(Request $request, $id)
    
        {
    
            $this->validate(request(), [
    
                'product_name' => 'required',
    
                'status' => 'required'
    
                
    
            ]);
    
            $product = Product::find($id);
    
           
    
            $product->product = $request->product_name;
    
            $product->status = $request->status;
    
            if($request->hasFile('product_image'))
    
            {
    
                //$filename = $request->profile_image->getClientOriginalName();
    
                $product->product_image = $request->product_image->store('images'); 
    
            }
    
            $product->save();
    
            return redirect('product')->with('success', 'Product has been updated.');
    
        }
        public function deletemul(Request $request)
        
            {
        
                $product = Product::find($request->val);
                
                $product->delete();
                return back()->with('success', 'Product has been deleted.');
               
            }
    
}
