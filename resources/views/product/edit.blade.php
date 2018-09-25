@extends('layouts.master')



@section('content')







<div class="row mt">

<div class="col-lg-1"></div>

          		<div class="col-lg-10">

              @include('layouts.error')

             

                  <div class="form-panel">



                  	  <h4 class="mb"></i>Product Form</h4>



<form method="POST" action="{{url('product/'.$product->id)}}" enctype="multipart/form-data">



{{csrf_field()}}



    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">


        <label for="exampleInputEmail1">Product Name</label>



        <input type="text" class="form-control" value="{{$product->product}}" name="product_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product Name" required>

        </div>
        <div class="col-lg-6">
        <label for="exampleFormControlFile1">Product Image</label>



    <input type="file" class="form-control-file"  name="product_image" id="exampleFormControlFile1" accept="image/*"></br>

    <img src="{{ url('storage/app/'.$product->product_image)}}" height="42" width="42">


        </div>
        </div>

    </div>


    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">

    <label for="exampleFormControlSelect1">Status</label>



    <select class="form-control"  name="status" id="exampleFormControlSelect1">



    <option value="0" @if($product->status == 0){{'selected'}}@endif>Enable</option>



    <option value="1" @if($product->status == 1){{'selected'}}@endif>Disable</option>



    </select>

    </div>
    </div>

  </div>



    



  <button type="submit" class="btn btn-primary">Submit</button></br></br>



</form>
</div>
</div>
<div class="col-lg-1"></div>
</div>


@endsection