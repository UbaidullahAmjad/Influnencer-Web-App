<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Raleway:500,800" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>403 Forbidden</title>

  <style>
      * {
  margin:0;
  padding: 0;
}
body{
  background: #233142;
  
}
.whistle{
  width: 20%;
  fill: #f95959;
  margin: 100px 40%;
  text-align: left;
  transform: translate(-50%, -50%);
  transform: rotate(0);
  transform-origin: 80% 30%;
  animation: wiggle .2s infinite;
}

@keyframes wiggle {
  0%{
    transform: rotate(3deg);
  }
  50%{
    transform: rotate(0deg);
  }
  100%{
    transform: rotate(3deg);
  }
}
h1{
  margin-top: -100px;
  margin-bottom: 20px;
  color: #ec607f;
  text-align: center;
  font-family: 'Raleway';
  font-size: 90px;
  font-weight: 800;
}
h2{
  color: #455d7a;
  text-align: center;
  font-family: 'Raleway';
  font-size: 30px;
  text-transform: uppercase;
}
  </style>
</head>
<body>
<a href="#" >
                <!--<x-application-logo class="w-20 h-20 fill-current text-gray-500" />-->
                <!-- <h2 style="font-size:25px; font-style:bold;"> <b>   Supplier Franchise Management</b> </h2> -->
                <center>
                    <img style="margin-bottom:150px;margin-top:70px;" src="{{asset('/images/logo1.png')}}" alt="">
                </center>
            </a>
<h1>404</h1>
<h2>Page Not Found</h2>
<center>
  @if(auth()->user()->user_type != 2)
  <a style="margin-top:40px;" href="{{ url('graph') }}" class="btn btn-success">Go to App</a>
  @else
  <a style="margin-top:40px;" href="{{ url('influencer_graph') }}" class="btn btn-success">Go to App</a>

  @endif
</center>
</body>
</html>
