<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use App\Services;
use App\Timeslot;
use App\Category;
use Excel;
use PDF;

class CustomerController extends Controller
{   
    //function _construct() { $this->global=null;} 

    public function index()
    {
        $customers = User::all();
        return view('customer.index',compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $this->validate(request(), [

              'email' => 'required|email|max:100|unique:users',
              'password' => 'required|confirmed',
              'fname' => 'required|string',
              'lname' => 'required|string',
          ]);

         /* function validateMobile($phone)
          {
              $pattern = "/^(05)\d{9}$/";
              if (!preg_match($pattern, $phone))
              {
                  return false;
              }
              return true;
          }
          $phone = $request->phone;
          if(!validateMobile($phone))
          {
            return back()->with('warning', 'please enter valid mobile number');
          }
         else
         {*/

            $user->email = $request->email;       
            $user->password = bcrypt($request->password);
            $user->first_name = $request->fname;
            $user->last_name = $request->lname;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->user = 1;

            if($request->hasFile('profile_image'))
            {
                $user->profile_image = $request->profile_image->store('images'); 
                return $user->profile_image;
            }
            $user->save();
            return redirect('customer')->with('success', 'Customer has been created.'); 

       //  }

    }

    public function delete($id)
    {

        $user = User::find($id);
        $u_id = $user->id;
        
                 $appointment = Appointment::where('user_id',$u_id)->get()->first();
        
                 if($appointment)
        
                 {
        
                     return back()->with('warning', 'This user can not deleted.');
        
                 }
        
                 else
                 {
                    $user->delete();
                    return back()->with('success', 'Customer has been deleted.');
                 }
       
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('customer.edit',compact('user'));
    }

    public function update(Request $request , $id)
    {
        $this->validate(request(), [

            'email' => 'required|email|max:100',
            'fname' => 'required|string',
            'lname' => 'required|string',
           

        ]);

        $user = User::find($id);
        $c_email = $user->email;
        $c_phone = $user->phone;

        if($c_email != $request->email  )
        {
            $email =  User::select('email')->get()->toArray();
            $a = (int)count($email);
            for($i=0;$i<$a;$i++)
            {
                if( $email[$i]['email'] == $request->email)
                {
                return back()->with('warning', 'please enter unique email ');
                }
            }
        }

       /* if($c_phone != $request->phone)
        {
                function validateMobile($phone)
                {
                    $pattern = "/^(0)\d{10}$/";
                    if (!preg_match($pattern, $phone))
                    {
                       return false;
                    }
                    return true;
                }
                $phone = $request->phone;
                if(!validateMobile($phone))
                {
                  return back()->with('warning', 'please enter valid mobile number');
                } 
        }  */

            $user->email = $request->email;       
            $user->first_name = $request->fname;
            $user->last_name = $request->lname;
            $user->phone = $request->phone;
            $user->gender = $request->gender;

            if($request->hasFile('profile_image'))
            {
                $user->profile_image = $request->profile_image->store('images'); 
            }
            $user->save();
            return redirect('customer')->with('success', 'Customer has been updated.'); 
        } 

        public function serch(Request $request)
        {   
           
            $j=0;
            $po = 0;
            $q = $request->search;
            $user = User::where('first_name','LIKE','%'.$q.'%')->orWhere('last_name','LIKE','%'.$q.'%')->orWhere('phone','LIKE','%'.$q.'%')->get();
          
            if($user)
            {   
                $users = array();
               
                foreach($user as $u)
                {   
                  
                    
                    $user_id = $u->id;
                    $user_fname = $u->first_name;
                    $user_lname = $u->last_name;
                    $email = $u->email;

                    $data = Appointment::where('user_id',$user_id)->get();
                  
                            $po = 0;
                            
                             $length=count($data);
                         
                            for ($i=0; $i < $length ; $i++) 
                            {
                          
                                $service = $data[$i]->service_id;
                                $services = Services::where('id',$service)->get();
                               foreach($services as $s)
                                    {
                                        $point= $s->point;
                                        $po = $po + $point;
    
                                        $data[$i]['service_name']=$s->name;
                                        $data[$i]['service_point']=$s->point;
                                        $data[$i]['first_name']=$user_fname;
                                        $data[$i]['last_name']=$user_lname;
                                        $data[$i]['email']=$email;
                                        $timeslote = Timeslot::where('id',$data[$i]['appointment_time'])->get();
                                        $categary_name = Category::select('category')->where('id',$s->category_id)->get();
                                        $data[$i]['timeslote']=$timeslote[0]->time_slot;
                                        $data[$i]['category_name']=$categary_name[0]->category;
                                        $fData[$user_id][$i]['service_name']=$s->name;
                                        /*  $finaldata[$i]['first_name']=$data[$i]['first_name'];
                                        $finaldata[$i]['last_name']=$data[$i]['last_name'];
                                        $finaldata[$i]['email']=$data[$i]['email'];
                                        $finaldata[$i]['category_name']=$data[$i]['category_name'];
                                        $finaldata[$i]['service_name']=$data[$i]['service_name'];
                                        $finaldata[$i]['service_point']=$data[$i]['service_point'];
                                        $finaldata[$i]['appointment_date']=$data[$i]['appointment_date'];
                                        $finaldata[$i]['appointment_time']=$data[$i]['timeslote'];
                                        session()->put('global_variable', $finaldata);
                                       */
                                     
                                   }
                               

                                
                            }
                           
                            array_push ($users, $data);
                        
                }
//return $users;
           return view('customer.point',compact('users'));
        }
     else

     {
        return back()->with('warning', 'No Match Found');

     }           

    }

/*public function export(){
 
      $final = session()->get('global_variable');
     Excel::create('clients', function($excel) use($final) {
            $excel->sheet('clients', function($sheet) use($final) {
                 $sheet->fromArray($final);
             });
         })->export('xls');
}*/


}

