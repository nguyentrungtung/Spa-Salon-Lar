
@extends('layouts.master')
@section('content')
<div class="row mt">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
        @if(Session::has('success'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif
         @if(Session::has('warning'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ Session::get('warning') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <div style="display:flex">
                    <h4><a href="{{url('customer/create')}}"><button class = "btn btn-primary">Add Customer</button></a></h4>
                        <form action="{{url('serch')}}" class="form-inline" role="form">                           
                        {{csrf_field()}}   
                            <div class="col-lg-6 input-group top_search" >
                                <input type="text" class="form-control" placeholder="Search" name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                          </div>                     
                        </form>
                <!--    <h4><a href="{{url('pdf')}}"><button class = "btn btn-primary">pdf</button></a></h4>-->
                </div>
	            <hr>
                <thead>
                    <tr> 
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Profile</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>@if($customer->gender == 0){{'Male'}}@else{{'Female'}}@endif</td>
                        <td>
                            @if($customer->profile_image == NULL)
                                <img src="{{'public/images/user.png'}}" height="42" width="42">
                            @else
                                <img src="{{ url('storage/app/'.$customer->profile_image)}}" height="42" width="42">
                            @endif
                        </td>
                        <td><a href="{{'customer/edit/'.$customer->id}}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>
                        <td><a  onclick="return confirm('Are you sure you want to delete it');"  href="{{'customer/delete/'.$customer->id}}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /content-panel -->
    </div><!-- /col-lg-12 -->
    <div class="col-lg-1"></div>
</div><!-- /row -->
@endsection







