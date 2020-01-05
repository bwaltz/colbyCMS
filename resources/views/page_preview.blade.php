@extends('layouts.frontend-layout')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 20px">
    <div class="col-lg-12"><div class="alert alert-warning" role="alert" style="text-align: center">
  Preview
</div></div>
</div>
    <div class="row">
    <div class="col-lg-10 mx-auto">
        <h3 class="mt-4">{{ $page->title }} <span class="lead"> by <a href="#"> {{ $page->user->name }} </a></span> </h3>
        <hr>
        <p>Posted {{ $page->created_at->diffForHumans() }} </p>
        <hr>
        @if(!empty($post->image))
        <img class="img-fluid rounded" src=" {!! '/storage/uploads/' . $post->image  !!} " alt="">
        <hr>
        @endif
        <p class="lead">{!! $page->body !!}</p>
    </div>
    </div>
</div>
@endsection

@section('scripts')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.6/css/froala_style.min.css' rel='stylesheet' type='text/css' />
@stop