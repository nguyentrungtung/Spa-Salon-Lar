
@extends('layouts.master')
@section('content')
<div class="row mt">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
        @if(Session::has('success'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <!-- <h4><a href="{{url('timeslot/create')}}"><button class = "btn btn-primary">Add New Record</button></a></h4>-->
                <h4>Time Slot</h4>
	            <hr>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Time Slot</th>    
                            <th>Status</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeslots as $timeslot)
                            <tr>
                                <td>{{$timeslot->id}}</td>
                                <td>{{$timeslot->time_slot}}</td>
                                <td>
                                    @if($timeslot->status == 0)
                                        <input type="hidden" class="getid" value="{{ $timeslot->id}}" />
                                        <span class="sendme label label-success label-mini" id="epointer">Enable</span>
                                    @else
                                        <input type="hidden" class="getid" value="{{ $timeslot->id}}" />
                                        <span class="sendme label label-warning label-mini" id="dpointer">Disable</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
            </table>
        </div><!-- /content-panel --> 
    </div><!-- /col-lg-12 -->
    <div class="col-lg-1"></div> 
</div><!-- /row -->
@endsection







