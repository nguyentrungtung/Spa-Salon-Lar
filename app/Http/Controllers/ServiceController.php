<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Services;

use App\Employee;

use App\Category;

use App\Appointment;

class ServiceController extends Controller

{

    public function index()

    {

      

        $services = Services::all();

        foreach($services as $s){

            $e=Employee::whereIn('id',$s->employee_id)->get();

            $s->employee=$e;

        }

        return view('service.index',compact('services'));

    }

    public function create()

    {

        $employeeids = Employee::all();

        $categoryids = Category::all();

        return view('service.create',compact('categoryids','employeeids'));

    }

    public function store(Request $request)

    {

        $service = new Services;

        $this->validate(request(), [

            'name' => 'required',

            'status' => 'required',

            'price' => 'required|numeric',

            'houre' => 'required|numeric',

            'minute' => 'required|numeric',

            'category' => 'required',

            'employeeid' => 'required'

            

        ]);

        $service->category_id = $request->category;

        $service->name = $request->name;

        if(isset($request->employeeid))

        {

            $service->employee_id = implode(',',  $request->employeeid);

        }

        else

        {

            return back()->with('warning', 'please first select employee for this service');

        }

        $service->status = $request->status;

        $service->price = $request->price;

        $service->point = $request->point;

        $service->houre = $request->houre;

        $service->minute = $request->minute;

        if($request->hasFile('service_image'))

        {

            $service->service_image = $request->service_image->store('images'); 

        }

        $service->save();

        return redirect('service');

    }

    public function edit($id)

    {

        $employeeids = Employee::all();

        $categoryids = Category::all();

        $service = Services::find($id);

        return view('service.edit',compact('service','categoryids','employeeids'));

    }

    public function delete($id)

    {

        $service = Services::find($id);

        $s_id = $service->id;

         $appointment = Appointment::where('service_id',$s_id)->get()->first();

         if($appointment)

         {

             return back()->with('warning', 'This service has not deleted.');

         }

         else

         {

             $service->delete();

            return back()->with('success', 'service has been deleted.');

         }



       

    }

    public function update(Request $request , $id)

    {

        $this->validate(request(), [

            'name' => 'required',

            'status' => 'required',

            'price' => 'required|numeric',

            'houre' => 'required|numeric',

            'minute' => 'required|numeric',

            'category' => 'required',

            'employeeid' => 'required'

            

        ]);

        

        $service = Services::find($id);

        $service->category_id = $request->category;

        $service->name = $request->name;

        if(isset($request->employeeid))

        {

            $service->employee_id = implode(',',  $request->employeeid);

        }

        else

        {

            return back()->with('warning', 'please first select employee for this service');

        }

        $service->status = $request->status;

        $service->price = $request->price;

        $service->point = $request->point;

        $service->houre = $request->houre;

        $service->minute = $request->minute;

        if($request->hasFile('service_image'))

        {

            $service->service_image = $request->service_image->store('images'); 

        }

        $service->save();

        return redirect('service');

    }
    public function deletemul(Request $request)
    
        {
    
            $services = Services::find($request->val);
            $appointment = Appointment::where('service_id',$request->val)->get()->first();
            if($appointment)
            {
                return back()->with('warning', 'First Delete This Service Appointment.');
            }
            $services->delete();
            return back()->with('success', 'Service has been deleted.');
           
        }
}

