<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\before_after;
use App\Services;
class BeforeAfterController extends Controller
{
    public function index()
    
        {
    
            $before_afters = before_after::all();
    
            return view('before_after.index',compact('before_afters'));
    
        }
    
        public function create()
    
        {
            $serviceids = Services::all();
            return view('before_after.create',compact('serviceids'));
    
        }
    
       public function store(Request $request)
    
        {
    
            $before_after = new before_after;
    
            $this->validate(request(), [
    
                'before_image' => 'required',
                'service_id' => 'required',
                'after_image' => 'required'
    
                
    
            ]);
    
            
    
            $before_after->service_id = $request->service_id;
            $before_after->status = $request->status;
    
            if($request->hasFile('before_image'))
    
            {
    
                //$filename = $request->profile_image->getClientOriginalName();
    
               $before_after->before_image = $request->before_image->store('images'); 
    
            }
            if($request->hasFile('after_image'))
            
                    {
            
                        //$filename = $request->profile_image->getClientOriginalName();
            
                       $before_after->after_image = $request->after_image->store('images'); 
            
                    }
           
    
            $before_after->save();
    
            return redirect('before_after')->with('success', 'Record has been created.');
    
        }
    
        public function delete($id)
    
        {
    
          $before_after = before_after::find($id);
                $before_after->delete();
    
                return back()->with('success', 'Record has been deleted.');
    
        }
    
        public function edit($id)
    
        {
            $serviceids = Services::all();
            $before_after = before_after::find($id);
    
            return view('before_after.edit',compact('before_after','serviceids'));
    
        }
    
       
    
       
    
        public function update(Request $request, $id)
    
        {
            $before_after = before_after::find($id);
            $this->validate(request(), [
                
                           
                            'service_id' => 'required',
                           
                            
                
                        ]);
                
                        
                
                
                        $before_after->status = $request->status;
                        $before_after->service_id = $request->service_id;
                        if($request->hasFile('before_image'))
                
                        {
                
                            //$filename = $request->profile_image->getClientOriginalName();
                
                           $before_after->before_image = $request->before_image->store('images'); 
                
                        }
                        if($request->hasFile('after_image'))
                        
                                {
                        
                                    //$filename = $request->profile_image->getClientOriginalName();
                        
                                   $before_after->after_image = $request->after_image->store('images'); 
                        
                                }
                       
                
                        $before_after->save();
                
                        return redirect('before_after')->with('success', 'Record has been updated.');
                
    
        }
        public function deletemul(Request $request)
        
            {
        
                $before_after = before_after::find($request->val);
               
                $before_after->delete();
                return back()->with('success', 'Record has been deleted.');
               
            }
}
