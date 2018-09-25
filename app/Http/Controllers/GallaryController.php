<?php

namespace App\Http\Controllers;
use App\Gallary;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    public function index()
    
        {
    
            $gallarys = Gallary::all();
    
            return view('gallary.index',compact('gallarys'));
    
        }
    
        public function create()
    
        {
    
            return view('gallary.create');
    
        }
    
       public function store(Request $request)
    
        {
    
            $gallary = new Gallary;
    
            $this->validate(request(), [
    
                'title' => 'required',
                'gallary_image' => 'required',
                'status' => 'required'
    
            ]);
            $gallary->title = $request->title;
    
            $gallary->status = $request->status;
    
            if($request->hasFile('gallary_image'))
    
            {
    
                //$filename = $request->profile_image->getClientOriginalName();
    
               $gallary->gallary_image = $request->gallary_image->store('images'); 
    
            }
            $gallary->save();
    
            return redirect('gallary')->with('success', 'Gallary has been created.');
    
        }
    
        public function delete($id)
    
        {
    
          $gallary = Gallary::find($id);
                $gallary->delete();
    
                return back()->with('success', 'Gallary has been deleted.');
    
          
    
        }
    
        public function edit($id)
    
        {
    
            $gallary = Gallary::find($id);
    
            return view('gallary.edit',compact('gallary'));
    
        }
    
       
    
       
    
        public function update(Request $request, $id)
    
        {
            $gallary = Gallary::find($id);
            $this->validate(request(), [
                
                            'title' => 'required',
                            'gallary_image' => 'required',
                            'status' => 'required'
                
                        ]);
                        $gallary->title = $request->title;
                
                        $gallary->status = $request->status;
                
                        if($request->hasFile('gallary_image'))
                
                        {
                
                            //$filename = $request->profile_image->getClientOriginalName();
                
                           $gallary->gallary_image = $request->gallary_image->store('images'); 
                
                        }
                        $gallary->save();
                
                        return redirect('gallary')->with('success', 'Gallary has been created.');
                
        }
        public function deletemul(Request $request)
        
            {
        
                $gallary = Gallary::find($request->val);
                
                $gallary->delete();
                return back()->with('success', 'Gallary has been deleted.');
               
            }
}
