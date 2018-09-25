
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <title> 
                @if(isset($settings->header_name))
                    {{$settings->header_name}}
                @else
                    {{'Galaxy Spa & Salon'}}
                @endif
        </title>
            @if(isset($settings->favicon))
                <link  rel="icon" href="{{ url('storage/app/'.$settings->favicon)}}" >
            @else
                <link rel="icon" href="{{ url('public/images/logo.png') }}"/>
            @endif
        
        <!-- Bootstrap core CSS -->
        <link href="{{url('public/css/bootstrap.css')}}" rel="stylesheet">
        <!--external css-->
        <link href="{{url('public/css/font-awesome.css')}}" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>   
        <!-- Custom styles for this template -->
        <link href="{{url('public/css/style.css')}}" rel="stylesheet">
        <script src="{{url('public/js/jscolor.js')}}"></script>
        <link href="{{url('public/css/style-responsive.css')}}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"/>
    </head>
    <body>
    <style>
        .header_logo{
            color:<?php if(isset($settings)) {echo $settings->header_text_color;} else { echo '#ffffff;' ;}?>;
        }
       
        ul.sidebar-menu li a{
            font-size:<?php if(isset($settings)) {echo $settings->menu_font_size;} else { echo '10;' ;}?>px!important;
            color:<?php if(isset($settings)) {echo $settings->menu_icon_color;} else { echo '#ffffff;' ;}?>!important;
        }
        ul.sidebar-menu li span {
            font-size:<?php if(isset($settings)) {echo $settings->menu_font_size;} else { echo '10;' ;}?>px!important;
            color:<?php if(isset($settings)) {echo $settings->menu_text_color;} else { echo '#82868b;' ;}?>!important;
        }
       /*
        ul.sidebar-menu li a:hover{
            background-color:<?php if(isset($settings)) {echo $settings->menu_hover_color;} else { echo '#2e363e;' ;}?>!important;
        }
       .active{
        background-color:<?php if(isset($settings)) {echo $settings->menu_hover_color;} else { echo '#2e363e;' ;}?>!important;     
        }
    #sidebar{
            background-color:<?php if(isset($settings)) {echo $settings->menu_background_color;} else { echo '#ffffff;' ;}?>;
        }*/
    
       .content{
            font-size:<?php if(isset($settings)) {echo $settings->content_text_size;} else { echo '10;' ;}?>px!important;
        }
    </style>
        <section id="container" >
            <header class="header black-bg">
                <!-- <div class="sidebar-toggle-box">
                
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                
                </div>-->
          
                <!--logo start-->
                <a href="{{url('dashboard')}}" class="logo">
                @if(isset($settings->header_logo))
                    <img src="{{ url('storage/app/'.$settings->header_logo)}}" >
                    @else
                    <img src="{{url('public/images/logo.png')}}"/>
                    @endif
                    
                    <b class="header_logo">
                    @if(isset($settings->header_name))
                    {{$settings->header_name}}
                    @else
                    {{'Galaxy Spa & Salon'}}
                    @endif
                    </b>
                </a>
    
                <!--logo end-->

                <div class="top-menu">  
                    <ul class="nav pull-right top-menu">  
                        <li>
                        <a class="logout" href="{{ route('logout') }}" style="float:right;"  
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        Logout
                            </a> 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">  
                                {{ csrf_field() }} 
                            </form> 
                        </li> 
                    </ul>  
                </div> 
            </header> 
            <aside> 
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li class="sub-menu {{ Request::path() == 'dashboard' ? 'active' : ''}} ">
                            <a href="{{url('dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'appointment' ? 'active' : ''}}">
                            <a href="{{url('appointment')}}">
                            <i class="fa fa-calendar"></i>
                                <span>Appointment</span>
                            </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'category' ? 'active' : ''}}">
                            <a href="{{url('category')}}">
                                <i class="fa fa-tags"></i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'employee' ? 'active' : ''}}">
                            <a href="{{url('employee')}}">
                                <i class="fa fa-users"></i>
                                <span>Employee</span>
                            </a>
                        </li>
                        <!--<li class="sub-menu {{ Request::path() == 'product' ? 'active' : ''}}">
                            <a href="{{url('product')}}">
                            <i class="fa fa-product-hunt"></i>
                                <span>Product</span>
                            </a>
                        </li>-->
                        <li class="sub-menu {{ Request::path() == 'service' ? 'active' : ''}}">
                            <a href="{{url('service')}}">
                                <i class="fa fa-briefcase"></i>
                                <span>Service</span>
                            </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'customer' ? 'active' : ''}}">
                            <a href="{{url('customer')}}">
                            <i class="fa fa-user"></i>
                              <span>Customer</span>
                          </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'gallary' ? 'active' : ''}}">
                          <a href="{{url('gallary')}}">
                          <i class="fa fa-picture-o"></i>
                              <span class="text">Gallary</span>
                          </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'before_after' ? 'active' : ''}}">
                          <a href="{{url('before_after')}}">
                          <i class="fa fa-trello"></i>
                              <span class="text">Before-After</span>
                          </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'complete_appointment' ? 'active' : ''}}">
                            <a href="{{url('complete_appointment')}}">
                            <i class="fa fa-calendar"></i>
                                <span>Complete Appointment</span>
                            </a>
                        </li>
                        <li class="sub-menu {{ Request::path() == 'timeslot' ? 'active' : ''}}">
                            <a href="{{url('timeslot')}}">
                            <i class="fa fa-clock-o"></i>
                                <span>Timeslot</span>
                            </a>
                        </li>
                        
                        <li class="sub-menu {{ Request::path() == 'setting' ? 'active' : ''}}">
                          <a href="{{url('setting')}}">
                          <i class="fa fa-cog"></i>
                              <span>Setting</span>
                          </a>
                        </li>
                        
                    </ul>
                <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    @section('content')
                    @show
                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->
            <footer class="site-footer">
                <div class="text-center">
                @if(isset($settings->footer_name))
                    {{$settings->footer_name}}
                @else
                    {{'Galaxy Spa & Salon'}}
                @endif
                    <a href="" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
        </section>
      <!-- js placed at the end of the document so the pages load faster -->


      <script src="{{url('public/js/jquery.js')}}"></script>
      <script src="{{url('public/js/status.js')}}"></script>
      <script src="{{url('public/js/bootstrap.min.js')}}"></script>
      <script src="{{url('public/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
      <script src="{{url('public/js/jquery.ui.touch-punch.min.js')}}"></script>
      <script class="include" type="text/javascript" src="{{url('public/js/jquery.dcjqaccordion.2.7.js')}}"></script>
      <script src="{{url('public/js/jquery.scrollTo.min.js')}}"></script>
      <script src="{{url('public/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
      <!--common script for all pages-->
      <script src="{{url('public/js/common-scripts.js')}}"></script>
      <!--script for this page-->

    </body>
</html>







