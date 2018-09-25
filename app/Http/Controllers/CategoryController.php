<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Category;

use App\Services;

class CategoryController extends Controller

{

    public function index()

    {

        $categorys = Category::all();

        return view('category.index',compact('categorys'));

    }

    public function create()

    {

        return view('category.create');

    }

   public function store(Request $request)

    {

        $category = new Category;

        $this->validate(request(), [

            'cname' => 'required',

            'status' => 'required'

            

        ]);

        

        $category->category = $request->cname;

        $category->status = $request->status;

        if($request->hasFile('category_image'))

        {

            //$filename = $request->profile_image->getClientOriginalName();

           $category->category_image = $request->category_image->store('images'); 

        }

       

        $category->save();

        return redirect('category')->with('success', 'Category has been created.');

    }

    public function delete($id)

    {

      $category = Category::find($id);

      $c_id = $category->id;

        $service = Services::where('category_id',$c_id)->get()->first();

        if($service)

        {

            return back()->with('warning', 'This Category has not deleted.');

        }

        else

        {

            $category->delete();

            return back()->with('success', 'Category has been deleted.');

        }

      

    }

    public function edit($id)

    {

        $category = Category::find($id);

        return view('category.edit',compact('category'));

    }

   

   

    public function update(Request $request, $id)

    {

        $this->validate(request(), [

            'cname' => 'required',

            'status' => 'required'

            

        ]);

        $category = Category::find($id);

       

        $category->category = $request->cname;

        $category->status = $request->status;

        if($request->hasFile('category_image'))

        {

            //$filename = $request->profile_image->getClientOriginalName();

            $category->category_image = $request->category_image->store('images'); 

        }

        $category->save();

        return redirect('category')->with('success', 'Category has been updated.');

    }
    public function deletemul(Request $request)
    
        {
    
            $category = Category::find($request->val);
            $service = Services::where('category_id',$request->val)->get()->first();
            if($service)
            {
                return back()->with('warning', 'First Delete This Category Service.');
            }
          
            $category->delete();
            return back()->with('success', 'Category has been deleted.');
           
        }

}

