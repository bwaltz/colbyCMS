<?php
    $advisors = [
        [
            'name' => 'Will Ryder', 
            'image' => 'http://placeimg.com/400/400/any', 
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus nibh ante, et consequat libero sollicitudin ac.'
        ], 
        [
            'name' => 'Susan Fredrick', 
            'image' => 'http://placeimg.com/400/400/animals', 
            'description' => 'Cras auctor lacinia enim, quis congue risus aliquet eget. Etiam ante lectus, ultricies ut libero in, dictum porta sapien. Fusce hendrerit luctus gravida. Quisque at lacinia eros.'
        ],
        [
            'name' => 'Allen Toomey', 
            'image' => 'http://placeimg.com/400/400/nature', 
            'description' => 'Cras auctor lacinia enim, quis congue risus aliquet eget. Etiam ante lectus, ultricies ut libero in, dictum porta sapien. Fusce hendrerit luctus gravida. Quisque at lacinia eros.'
        ]
    ];

    $advisor = $advisors[rand(0, 2)];
    ?>

@extends('layouts.admissions-layout')
@section('scripts') 
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
@stop

@section('styles') 
<style>


#navbar {
  overflow: hidden;
  background-color: #5a9df1;
  display: flex;
    align-items: center;
    justify-content: center;
}

#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
    background-color: #e4e4e4;
    color: black;
}


.sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 100;
}

</style>
@stop
@section('content')
<!-- Header - set the background image for the header in the line below -->
@if(!empty($page->image))
<div class="container-fluid px-0">
    <div class="row">
    <img class="img-fluid w-100" width="1600" height="985" src="{!! '/storage/uploads/' . $page->image  !!}" alt="">
</div>
</div>

<div id="navbar">
  <a  href="javascript:void(0)">Home</a>
  <a class="active" href="javascript:void(0)">News</a>
  <a href="javascript:void(0)">Contact</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8" style="padding-top: 20px">
        {!! $page->body !!}
        </div>
        <div class="col-md-4" style="background-color: #f3f3f3; padding-top: 20px; display: flex;
    flex-direction: column;
    align-items: center;">
            <div><h3>Advisor Showcase</h3>
            <div class="row d-flex">
                <?php
                    $advisors[rand(0, 2)]
                ?>
                <div class="col-md-12 d-flex ">
                    <div class="card" style="width: 18rem;">
                        <img src="{!! $advisor['image'] !!}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{!! $advisor['name'] !!}</h5>
                            <p class="card-text">{!! $advisor['description'] !!}</p>
                        </div>
                    </div>
                </div>
            </div></div>
            <div style="margin-top: 60px">
            <button style="

    padding: 30px;
    background: #1b8476;
    border-radius: 5px;
    text-transform: uppercase;
    color: white;
    font-size: 1.4em;
">APPLY</button>
<button style="

padding: 30px;
background: #f5822e;
border-radius: 5px;
text-transform: uppercase;
color: white;
font-size: 1.4em;
">Inquire</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.6/css/froala_style.min.css' rel='stylesheet' type='text/css' />
@stop


