@extends('layouts.master')
@section('content')
@include('layouts.error')
<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i>TimeSlot Form</h4>
<form method="POST" action="{{url('timeslot')}}">
    {{csrf_field()}}
    <div class="form-group">
    <label for="exampleInputPassword1">Time Slot</label>
    <select class="form-control"  name="time_slot" id="exampleFormControlSelect1">
    <?php
    $start=strtotime('00:00');
    $end=strtotime('23:59');
    ?>
    @for($i=$start;$i<=$end;$i=$i+30*60)      
        <option value='{{ date('g:i a', $i)}}'> {{ date('g:i a', $i) }}</option>        
    @endfor
   
</select>
</div>
<div class="form-group">
<label for="exampleFormControlSelect1">Status</label>
<select class="form-control"  name="status" id="exampleFormControlSelect1">
    <option value="0">Enable</option>
    <option value="1">Disable</option>
</select>
</div>

    
  <button type="submit" class="btn btn-primary">Submit</button></br></br>
</form>
</div>
        </div>    
    </div>
    
@endsection