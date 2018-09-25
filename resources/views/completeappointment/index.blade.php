@extends('layouts.master')
@section('content')
<script type="text/javascript">
    function do_this()
    {
        var checkboxes = document.getElementsByName('record[]');
        var button = document.getElementById('btn4');
        if(button.value == 'Select All')
        {
            for (var i in checkboxes)
            {
                checkboxes[i].checked = 'FALSE';
            }
            button.value = 'Deselect'
        }
        else
        {
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.value = 'Select All';
        }
    }

    $(function() 
    {	
        $(document).on('click', ".submit", function() 
        {
            var val = [];
            $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
            //alert(val[i]);
            $.ajax({
                url: "complete_appointment/deletemul",
                type: "get",
                data: {
                    '_token': $('input[name = _token]').val(),
                    val: val[i],
                },
                success: function(d) {
                    window.location.reload();
                }
            });		
        });			
    });
});

</script>
<div class="col-lg-12 mt">
    <div class="content-panel">
        <table class="table table-striped table-advance table-hover">
            <h4>Complete Appointment</h4>
	        <hr>
            <thead>
                <tr>
                    <th class="multi">
                        <input type="button" id="btn4" class = "btn btn-success btn-xs" value="Select All" onClick="do_this()" />                                                         
                        <button type="submit" name="submit" class = "btn btn-danger btn-xs submit" ><i class="fa fa-trash-o "></i></button>
                    </th>
                    <th>User Name</th>
                    <th>Service Name</th>
                    <th>Employee Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment time</th>
                    <th>Service Duration</th>
                    <th>Amount</th>  
                    <th>Internal note</th> 
                    <th>Payment status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td><input type="checkbox" name="record[]" value="{{$appointment->id}}" class="checkbox"></td>
                    <td>{{$appointment->user_name}}</td>
                    <td>{{$appointment->service_name}}</td>  
                    <td>{{$appointment->employee_name}}</td>
                    <td>{{$appointment->appointment_date}}</td>
                    <td>{{$appointment->appointment_time}}</td>
                    <td>{{$appointment->service_duration}}</td>
                    <td><label>$</label>{{$appointment->price}}</td> 
                    <td>@if($appointment->internal_note){{$appointment->internal_note}} @else {{'no any internal note'}}@endif</td>
                    <td>@if($appointment->payment_status == 0)<span class="label label-warning label-mini">Unpaid</span>@else<span class="label label-success label-mini">Paid</span>@endif</td>
                </tr>
            @endforeach 
            </tbody>
        </table>
    </div><!-- /content-panel -->
</div><!-- /col-lg-12 -->
@endsection