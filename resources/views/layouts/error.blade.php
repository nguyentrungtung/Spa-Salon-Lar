@if(count($errors))

  <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
   

   @foreach($errors->all() as $error)

    <p>{{$error}}</p>

    @endforeach

  </div>
                </div>
            </div>

@endif
