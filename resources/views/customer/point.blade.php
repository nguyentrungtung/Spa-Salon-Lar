@extends('layouts.master')

<!-- search vali -->

@section('content')

<div class="row mt">

<div class="col-lg-1"></div>

                  <div class="col-lg-10">

 

                      <div class="content-panel">



                          <table class="table table-striped table-advance table-hover">



                         

                      <!-- <h4><a href="{{url('export')}}"><button class = "btn btn-primary">Export</button></a></h4> -->

                         

	                  	  	  <hr>



                              <thead>



                                <tr>



                                  <th>User Name</th>

                                  <th>Email</th>

                                  <th>Category</th>

                                  <th>Service</th>

                                  <th>Point</th>

                                  <th>Appointment Date</th>

                                  <th>Appointment Time</th>



                                </tr>



                              </thead>



                              <tbody>



                              @foreach($users as $e)
                              @foreach($e as $employee)

                                <tr>



                                    <td>{{$employee->first_name}} {{$employee->last_name}}</td>

                                    <td>{{$employee->email}}</td>

                                    <td>{{$employee->category_name}}</td>

                                    <td>{{$employee->service_name}}</td>                                 

                                    <td>{{$employee->service_point}}</td>

                                    <td>{{$employee->appointment_date}}</td>                                 

                                    <td>{{$employee->timeslote}}</td>

                                    

                                </tr>


                                @endforeach 
                                @endforeach 



                              </tbody>



                          </table>



                      </div><!-- /content-panel -->



                  </div><!-- /col-lg-12 -->

                  <div class="col-lg-1"></div>

              </div><!-- /row -->



@endsection