<?php



namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Services;
use App\User;
use App\Employee;
use App\Appointment;
use App\Category;
use App\Timeslot;
use App\Product;
use App\Setting;
use App\token;
use App\Gallary;
use App\before_after;
use App\complete_appointment;
use Mail;
use Crypt;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registration(Request $request)
    {
        $user = new User;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'gender' => 'required',
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['code'=>401,'error'=>$validator->errors()], 401);            
            }
            else
            {
                $user->email = $request->email;       
                $user->password = bcrypt($request->password);
                $user->first_name = $request->fname;
                $user->last_name = $request->lname;
                $user->user = 1;

                if($request->phone)
                {
                    $user->phone = $request->phone;
                }
                else
                {
                    $user->phone = 0;
                }

                $user->gender = $request->gender;
                if($request->hasFile('profile_image'))
                {
                    $user->profile_image = $request->profile_image->store('images'); 
                }
                $user->save();

                return response(
                    ['code'=>200,'msg'=>'successful'],200
                );
            }

    }

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    ['code'=>401, 'error' => 'invalid_credentials'], 401
                );
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(
                ['code'=>500, 'error' => 'could_not_create_token'], 500
            );
        }
        $user = User::where('email',$request->email)->get()->first();
        
       $token_save = new token;
       $token_save->user_id = $user->id;
       $token_save->token = 'bearer '.$token;
       if($token_save->save())
       {
           $u_token = $token_save->token;
           $code = 200;
           $msg = 'login successful';
           
           // all good so return the token
           return response()->json(
               compact('code', 'msg','u_token')
           );
           
       }
    }
    public function login_wp(Request $request)
    {
        // grab credentials from the request 
        //$user = 0;
      
      
        $credentials = $request->only('email', 'password', 'user');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    ['code'=>401, 'error' => 'invalid_credentials'], 401
                );
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(
                ['code'=>500, 'error' => 'could_not_create_token'], 500
            );
        }
        $user = User::where('email',$request->email)->get()->first();
        if($user->user == 0)
        {

            $token_save = new token;
            $token_save->user_id = $user->id;
            $token_save->token = 'bearer '.$token;
            if($token_save->save())
            {
                $u_token = $token_save->token;
                $secret_key = $user->secret_key;
                $code = 200;
                $msg = 'login successful';
                
                // all good so return the token
                return response()->json(
                    compact('code', 'msg','u_token','secret_key')
                );
                
            }
        }
      
    }
    public function service()
    {
        $service = Services::all();
        $lenth = count($service);

       for($i=0;$i<$lenth;$i++)
       {
            //return $service[$i]->service_image;
            $service[$i]->service_image =  url("storage/app/" . $service[$i]->service_image);      
       }
        return response(
            ['code'=>200, 'msg'=>'service return successfuly', 'data'=> $service],200
        );
    }
    public function service_id(Request $request)
    {
        
        $service = Services::find($request->service_id);
        $service->service_image =  url("storage/app/" . $service->service_image);      
     
        return response(
            ['code'=>200, 'msg'=>'service return successfuly', 'data'=> $service],200
        );
    }
    public function employee()
    {
        $employee = Employee::all();
        $lenth = count($employee);

        for($i=0;$i<$lenth;$i++)
        {
         //    return $service[$i]->service_image;
         $employee[$i]->profile_image =  url("storage/app/" . $employee[$i]->profile_image);
        }

        return response(
            ['code'=>200, 'msg'=>'successful', 'data'=> $employee],200
        );
    }
    public function employee_id(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        
         $employee->profile_image =  url("storage/app/" . $employee->profile_image);
     
        return response(
            ['code'=>200, 'msg'=>'successful', 'data'=> $employee],200
        );
    }
 

    public function appointment(Request $request)
    {
        $appointment = new Appointment;
        //  $duration = Services::find($request->service_id);
              
        $this->validate(request(), [
            'service_id' => 'required'                     
        ]);

        $service = $request->service_id;
        $sev = Services::find($service);
        $ser_name = $sev->name;
        $emp_id = $sev->employee_id;
        $h = $request->appointment_date;  
        $d = $request->appointment_time;
        $app_time = Timeslot::find($d);
        $time = $app_time->time_slot;
        //$e = $request->employee_id;
        $flag=0;
        for ($i=0; $i < sizeof($emp_id); $i++) 
        { 
            $a = Appointment::where('appointment_date',$h)->where('appointment_time',$d)->where('employee_id',$emp_id[$i])->get();
            $c = count($a);
            if($c>0)
            {
                     
            }
            else
            {    
                $appointment->user_id = Auth::user()->id;
                $appointment->service_id = $request->service_id;
                $appointment->employee_id =$emp_id[$i];
                $appointment->appointment_date = $request->appointment_date;
                $appointment->appointment_time = $request->appointment_time;
                $appointment->payment_status = $request->payment_status;
                $appointment->status = $request->status;
                $appointment->save();
                $flag=1;
                break;
            }
        }
        if($flag==1)
        {
            $success = 'Your appointment book successfully';
              
            $to      = Auth::user()->email;
            $subject = 'razoredge';
            $message = 'your appointment was book on '.$h. ' at '.$time. ' ,service of '.$ser_name;
            $headers = 'From: saloonapp@thirstydevs.in' ;

            mail($to, $subject , $message, $headers);
             
            return response(
                ['code'=>200, 'msg'=>'successful', 'data'=> Appointment::all()],200
            );
                
        } 
        else 
        {  
            return response(
                ['code'=> 208,'msg'=>'Choose different time slot'],208   
            );
        }
    }  

        public function forgot_password(Request $request)
        {
            $password = User::where('email',$request->email)->get()->first();
            if($password)
            {
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
                $hashed_random_password = substr( str_shuffle( $chars ), 0, 8 );
                $password->password = bcrypt($hashed_random_password);
                $password->save();

                $to      = $request->email;
                $subject = 'razoredge';             
                $message = 'your Password is '.$hashed_random_password;
                $headers = 'From: saloonapp@thirstydevs.in' ;

                mail($to, $subject , $message, $headers);   
  
                return response(
                    ['code'=>200, 'msg'=>'Your password has been send in your gmail'],200
                );
            }
            else
            {
                return response(
                    ['code'=>401, 'msg'=>'please enter register email'],401
                );
            }
        }   

        public function userdata(Request $request)
        {
            $user= Auth::user();
         //   $data = User::where('id',$request->id)->where('email',$request->email)->get();
            $d = count($user);
           if($d>0)
           {
            return response(
                ['code'=>200, 'msg'=>'data return successfuly', 'data'=> $user],200
            );
           }
           else
           {
            return response(
                ['code'=>401, 'msg'=>'data is not found'],401
            );
           }            
        }

        public function facebook(Request $request)
        {
        $validator = Validator::make($request->all() , ['email' => 'required|email|max:100', 'fname' => 'required|string', 'lname' => 'required|string', 'gender' => 'required', ]);
        if ($validator->fails())
            {
            return response()->json(['code' => 401, 'error' => $validator->errors() ], 401);
            }
          else
            {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
            $hashed_random_password = substr(str_shuffle($chars) , 0, 8);
            $userrepeat = User::where('email', $request->email)->get()->first();
            $request->password = $hashed_random_password;
            $parts = explode('/', $request->profile_image);
            $name=sizeof($parts);
             $name--;
             $name = $parts[$name];
             $img="images/".$name;
             $url = $request->profile_image;
			//$path = 'https://i.stack.imgur.com/koFpQ.png';

			//$filename = basename($url);

			//Image::make($url)->save(public_path('images/' . $filename));

            //file_put_contents($img, file_get_contents($url));

            if ($userrepeat)
            {
                $userrepeat->email = $request->email;
                $userrepeat->first_name = $request->fname;
                $userrepeat->last_name = $request->lname;
                $userrepeat->password = bcrypt($hashed_random_password);
                $userrepeat->phone = $request->phone;
                $userrepeat->gender = $request->gender;
                $userrepeat->profile_image = $request->profile_image;
                $userrepeat->save();
            }
            else
            {

                $user = new User;
                $user->email = $request->email;
                $user->first_name = $request->fname;
                $user->last_name = $request->lname;
                $user->password = bcrypt($hashed_random_password);
                $user->phone = $request->phone;
                $user->gender = $request->gender;
                $user->profile_image = $request->profile_image;
                $user->save();
            }
            $data['email']=$request->email;
            $data['password']=$hashed_random_password;

            $credentials = $data;
            try
            {
                // attempt to verify the credentials and create a token for the user
                if (!$token = JWTAuth::attempt($credentials))
                    {
                    return response()->json(['code' => 401, 'error' => 'invalid_credentials'], 401);
                    }
                }

            catch(JWTException $e)
                {

                // something went wrong whilst attempting to encode the token

                return response()->json(['code' => 500, 'error' => 'could_not_create_token'], 500);
                }
    
            $code = 200;
            $msg = 'login successful';
            // all good so return the token

            return response()->json(compact('code', 'msg', 'token'));
            // return response(

            //      ['code'=>200,'msg'=>'successful','data'=>$hashed_random_password],200

            // );
            }
        }


 public function userpoint(Request $request)

    {

        $user= Auth::user();

        $u = $user->id;

         $data = Appointment::where('user_id',$u)->get();



        $po = 0;

         $dataa = array();

       

         $length=count($data);

     

        for ($i=0; $i < $length ; $i++) { 

            $service = $data[$i]->service_id;

            $services = Services::where('id',$service)->get();

            

            foreach($services as $s)

                {

                    $point= $s->point;

                    $po = $po + $point;

                    $data[$i]['service_name']=$s->name;

                    $data[$i]['service_point']=$s->point;

                    $timeslote = Timeslot::where('id',$data[$i]['appointment_time'])->get();

                    $categary_name = Category::select('category')->where('id',$s->category_id)->get();

                    $data[$i]['timeslote']=$timeslote[0]->time_slot;

                    $data[$i]['category_name']=$categary_name[0]->category;

                   

                }

        }

        $Finaldata['Totalpoint']=$po;

        $Finaldata['appointment']=$data;





return response(

        ['code'=>200,'msg'=>'successful','data'=>$Finaldata ],200



    );

       

    }

    public function category()

    {

      $data = Category::all();

      $lenth = count($data);

      for($i=0;$i<$lenth;$i++)

      {

       //    return $service[$i]->service_image;

       $data[$i]->category_image =  url("storage/app/" . $data[$i]->category_image);

        

      }

       return response(

        ['code'=>200,'msg'=>'successful', 'data'=>$data ],200



    );

       

    }
    public function product()
    
        {
    
          $data = Product::all();
    
          $lenth = count($data);
    
          for($i=0;$i<$lenth;$i++)
    
          {
    
           //    return $service[$i]->service_image;
    
           $data[$i]->product_image =  url("storage/app/" . $data[$i]->product_image);
    
            
    
          }
    
           return response(
    
            ['code'=>200,'msg'=>'successful', 'data'=>$data ],200
    
    
    
        );
    
           
    
        }
 public function changepassword(Request $request)

    {

    $user= Auth::user();

    // $password = User::find(2);

    

   if(password_verify($request->oldpass,$user->password))

   {

       $user->password = bcrypt($request->newpass);

       $user->save();

      

       return response(

        ['code'=>200,'msg'=>'successful','data'=>'Your password successfuliy change.'],200



    );

   }

   else

   {

    return response(

        ['code'=>401,'msg'=>'please enter valid old password'],401



    );

   }  

}   

public function logout(){
    $d = getallheaders();
    $token = $d['Authorization'];
    $user = token::where('token',$token)->get()->first();
    $user->delete();
    $data = explode(" ",$token);
    $token= $data[1];
    JWTAuth::invalidate($token);
    
}

public function category_service(Request $request){

    

           $services = Services::where('category_id',$request->id)->get();

           $lenth = count($services);
                  for($i=0;$i<$lenth;$i++)

                  {

                   //    return $service[$i]->service_image;

                   $services[$i]->service_image =  url("storage/app/" . $services[$i]->service_image);

                    

                  }

           return response(

            ['code'=>200,'msg'=>'successful', 'data'=>$services ],200

    

        );   

}
public function otherStuff(){
    
   // Services::truncate();
   
}
public function timeslot(Request $request){

  
     $service = Services::find($request->service_id);

      $empid = $service->employee_id;

    $count = count($empid);

 

      foreach($empid as $eid)

      {



         $emid = Employee::find($eid);

         $from_hours = $emid->min('from_hours');

          $to_hours = $emid->max('to_hours');

      }

      $data = array();

      $j=0;

   

      for($i=$from_hours;$i<=$to_hours;$i++)

      {



        $service = Timeslot::find($i);

        $timeslot = $service->time_slot;

        $timesloteId=$service->id;

     

        $appointment = Appointment::where('appointment_date',$request->appointment_date)

                                    ->where('service_id',$request->service_id)

                                    ->where('appointment_time',$timesloteId)

                                    ->get();

                                  

        if(sizeof($appointment)>=$count){

            $data[$j]['status']='disable';

            $data[$j]['time']=$timeslot;

            $data[$j]['timesloteId']=$timesloteId;

        }

        else{

            $data[$j]['status']='enable';

            $data[$j]['time']=$timeslot;

            $data[$j]['timesloteId']=$timesloteId;

            

        }

        $j++;

      }

      

       return response(

        ['code'=>200,'msg'=>'successful', 'data'=>$data],200



     );   

    }
    public function setting()
    {
        $data = Setting::latest()->first();
        $logo = $data->app_logo;
               //    return $service[$i]->service_image;
        
               $logo =  url("storage/app/" . $logo);
        
        
               return response(
        
                ['code'=>200,'msg'=>'successful', 'data'=>$logo ],200
        
        
        
            );
        
    }
    public function gallary()
    {
    $gallary = Gallary::where('status',0)->get();
    $lenth = count($gallary);
    for($i=0;$i<$lenth;$i++)

    {
     $gallary[$i]->gallary_image =  url("storage/app/" . $gallary[$i]->gallary_image);

    }
        return response(
            ['code'=>200, 'gallary'=>$gallary],200
        );
    }
    public function before_after()
    {
    $before_after = before_after::where('status',0)->get();
    $lenth = count($before_after);
    for($i=0;$i<$lenth;$i++)

    {
     $before_after[$i]->before_image =  url("storage/app/" . $before_after[$i]->before_image);
     $before_after[$i]->after_image =  url("storage/app/" . $before_after[$i]->after_image);
    }
        return response(
            ['code'=>200, 'before_after'=>$before_after],200
        );
    }
    public function token()
    {
    $token = token::all();
        return response(
            ['code'=>200, 'token'=>$token],200
        );
    }
}

