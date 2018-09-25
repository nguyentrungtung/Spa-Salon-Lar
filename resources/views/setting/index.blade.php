@extends('layouts.master')

@section('content')

<div class="row mt">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">

    @include('layouts.error')
    <div class="form-panel">
            <h4 class="mb">Setting Form </h4>
            <form method="POST" action="{{url('setting/store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
               
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Header Name</label>
                                    <input type="text" class="form-control" name="header_name" value="@if(isset($setting)){{$setting->header_name}}@endif" id="exampleInputEmail1" placeholder="Header Name" aria-describedby="emailHelp">  
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Footer Name</label>
                                    <input type="text" class="form-control" name="footer_name" value="@if(isset($setting)){{$setting->footer_name}}@endif" id="exampleInputEmail1"  placeholder="Footer Name" aria-describedby="emailHelp">  
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="exampleFormControlFile1">App Logo</label>
                                        <input type="file" class="form-control-file"  name="app_logo" id="exampleFormControlFile1" accept="image/*"></br>
                                        <img src="@if(isset($setting)) {{ url('storage/app/'.$setting->app_logo)}} @endif" height="42" width="42">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="exampleFormControlFile1">Admin Logo</label>
                                        <input type="file" class="form-control-file"  name="header_logo" id="exampleFormControlFile1" accept="image/*"></br>
                                        <img src="@if(isset($setting)) {{ url('storage/app/'.$setting->header_logo)}} @endif" height="42" width="42">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Content Text Size</label>
                                        <input type="number" class="form-control" name="content_text_size" value="@if(isset($setting)){{$setting->content_text_size}}@endif" id="exampleInputEmail1" aria-describedby="emailHelp"  min="0">  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Menu Font Size</label>
                                        <input type="number" class="form-control" name="menu_font_size" value="@if(isset($setting)){{$setting->menu_font_size}}@endif" id="exampleInputEmail1" aria-describedby="emailHelp"  min="0">  
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Menu Background Color </label>
                                        <input class="jscolor {hash:true} form-control" name="menu_background_color" value="@if(isset($setting)) {{$setting->menu_background_color}} @endif" id="exampleInputEmail1" aria-describedby="emailHelp">  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Menu hover Color</label>
                                        <input class="jscolor {hash:true} form-control" name="menu_hover_color" value="@if(isset($setting)) {{$setting->menu_hover_color}} @endif" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Menu Text Color</label>
                                        <input class="jscolor {hash:true} form-control" name="menu_text_color" value="@if(isset($setting)) {{$setting->menu_text_color}} @endif" id="exampleInputEmail1" aria-describedby="emailHelp">  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Menu Icon Color</label>
                                        <input class="jscolor {hash:true} form-control" name="menu_icon_color" value="@if(isset($setting)) {{$setting->menu_icon_color}} @endif" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Logo Text Color</label>
                                        <input class="jscolor {hash:true} form-control" name="header_text_color" value="@if(isset($setting)) {{$setting->header_text_color}} @endif" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Favicon</label>
                                        <input type="file" class="form-control-file"  name="favicon" id="exampleFormControlFile1" accept="image/*"></br>
                                        <img src="@if(isset($setting)) {{ url('storage/app/'.$setting->favicon)}} @endif" height="42" width="42">
                                    </div>
                                </div>
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