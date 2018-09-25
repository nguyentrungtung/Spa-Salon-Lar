

@extends('layouts.master')

@section('content')
<script type="text/javascript">

    function do_this(){

        var checkboxes = document.getElementsByName('record[]');
        var button = document.getElementById('btn4');

        if(button.value == 'Select All'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.value = 'Deselect'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.value = 'Select All';
        }
    }


    $(function() {	
        $(document).on('click', ".submit", function() {
            var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
         //   alert(val[i]);
          
            $.ajax({
                url: "gallary/deletemul",
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

        @if(Session::has('warning'))

            <div class="row">

                <div class="col-xs-12">

                    <div class="alert alert-warning alert-dismissable">

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span

                                    aria-hidden="true">&times;</span></button>

                        {{ Session::get('warning') }}

                    </div>

                </div>

            </div>

        @endif

                      <div class="content-panel">



                          <table class="table table-striped table-advance table-hover">



                          <h4><a href="{{url('gallary/create')}}"><button class = "btn btn-primary">Add</button></a></h4>



	                  	  	  <hr>



                              <thead>



                                <tr>
                                <th class = "multi">
                                    <input type="button" id="btn4" class = "btn btn-success btn-xs" value="Select All" onClick="do_this()" />                                                         
                                    <button type="submit" name="submit" class = "btn btn-danger btn-xs submit" ><i class="fa fa-trash-o "></i></button>
                                </th>
                                <th>Title</th>



                                <th>Gallary Image</th>



                                <th>Status</th>



                                <th>Edit</th>



                                <th>Delete</th>



                                </tr>



                              </thead>



                              <tbody>



                              @foreach($gallarys as $gallary)



                              



                                <tr>



                               

                                <td><input type="checkbox" name="record[]" value="{{$gallary->id}}" class="checkbox"></td>

                                <td>{{$gallary->title}}</td>

                                <td>

                               @if($gallary->gallary_image == NULL)

                               <img src="{{'public/images/category.png'}}" height="42" width="42">

                             @else

                             <img src="{{ url('storage/app/'.$gallary->gallary_image)}}" height="42" width="42">

                             @endif

                                </td>



                                    <td>@if($gallary->status == 0)<span class="label label-success label-mini">Enable</span>@else<span class="label label-warning label-mini">Disable</span>@endif</td>



                                    <td><a href="{{'gallary/edit/'.$gallary->id}}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>



                                    <td><a  onclick="return confirm('Are you sure you want to delete it');"  href="{{'gallary/delete/'.$gallary->id}}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a></td>



                                </tr>



                                @endforeach 



                              </tbody>



                          </table>



                      </div><!-- /content-panel --> 



                  </div><!-- /col-lg-12 -->


                  <div class="col-lg-1"></div>
              </div><!-- /row -->







@endsection







