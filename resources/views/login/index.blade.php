<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="Dashboard">

    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">



    <title>razoredge</title>



    <!-- Bootstrap core CSS -->

    <link href="{{url('public/css/bootstrap.css')}}" rel="stylesheet">

    <!--external css-->

    <link href="{{url('public/css/font-awesome.css')}}" rel="stylesheet" />

        

    <!-- Custom styles for this template -->

    <link href="{{url('public/css/style.css')}}" rel="stylesheet">

    <link href="{{url('public/css/style-responsive.css')}}" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

  </head>



  <body>



      <!-- **********************************************************************************************************************************************************

      MAIN CONTENT

      *********************************************************************************************************************************************************** -->



	  <div id="login-page">

	  	<div class="container">

        

		      <form class="form-login" action="{{url('/login')}}" method= "POST">

              

              {{csrf_field()}}

		        <h2 class="form-login-heading">sign in now</h2>

		        <div class="login-wrap">

		            <input type="email" name="email" class="form-control" placeholder="User ID" autofocus>

		            <br>

		            <input type="password"  name="password" class="form-control" placeholder="Password">

		            <label class="checkbox">

		                <span class="pull-right">

		                    <a data-toggle="modal" href="login.html#myModal"></a>

		

		                </span>

		            </label>

		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>

		            <hr>

		            

		            @include('layouts.error')

		        </div>

		      </form>	  	

	  	

	  	</div>

	  </div>



    <!-- js placed at the end of the document so the pages load faster -->

    <script src="{{url('public/js/jquery.js')}}"></script>

    <script src="{{url('public/js/bootstrap.min.js')}}"></script>



    <!--BACKSTRETCH-->

    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->

    <script type="text/javascript" src="{{url('public/js/jquery.backstretch.min.js')}}"></script>

    <script>

        $.backstretch("assets/img/login-bg.jpg", {speed: 500});

    </script>





  </body>

</html>



