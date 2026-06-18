
@extends('layouts.app-all')

@section('title', 'Maintenance Page')

@section('content')

<?php
$pagename = "Maintenance Page";
?>


<title>Performing Maintenance</title>

<style type="text/css">
      body { text-align: center; padding: 150px; }
      h1 { font-size: 40px; text-align: center; }
	h2 { text-align: center; }
      body { font: 20px Helvetica, sans-serif; color: #333; }
      #article { display: block; text-align: left; width: 650px; margin: 0 auto; }
      a { color: #FFFFFF; text-decoration: none; }
      a:hover { color: #FFFFFF; text-decoration: none; }
      img { width: 450px; height:450px; display: block; margin-left: auto; margin-right: auto;}
      button {
        background-color: #6265d8;
        border: none;
        border-radius: 4px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: block;
        margin-left: auto; margin-right: auto;
        font-size: 20px;
        }
    </style>

</head>
<body>
<div id="article">
  <h1>Apologies for the inconvenience, this service is currently unavailable due to unforeseen circumstances.</h1>
<h2>We will announce once the issue has been resolved.</h2>
<img class="w-full" src="/img/Wavy_Tech-08_Single-04.png">

<div>
    <button><a href="{{ url('/home')}}">Home</a></button>
</div>
</div>
    </body>
@endsection
