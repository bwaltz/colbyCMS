{{-- File: ./resources/views/single.blade.php --}}
@extends('layouts.frontend-layout')
@section('content')
@if($settings['emergency']->isEmergency)
      <section style="background-color: red; color: white; padding: 20px 0;">
        <div class="container">
          <div class="row" style="margin-top: 20px">
            <div class="col-lg-12">
              <div>
                {{ $settings['emergency']->emergencyHeader }}
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif
<div class="container fr-view">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h3 class="mt-4">{{ $post->title }} <span class="lead"> by <a href="#"> {{ $post->user->name }} </a></span> </h3>
      <hr>
      <p>Posted {{ $post->created_at->diffForHumans() }} </p>
      <hr>
      @if(!empty($post->image))
      <img class="img-fluid rounded" src=" {!! '/storage/uploads/' . $post->image  !!} " alt="">
      <hr>
      @endif
      <p class="lead">{!! $post->body !!}</p>
    </div>
    <div class="col-md-4">
      <div>{!! $postSidebarNav->asUl( ['class' => 'awesome-ul'] ) !!}</div>
      <div style="margin-top: 20px;">
        Colby College<br>
        Mayflower Hill Drive<br>
        Waterville, ME 04901<br>
        207-859-4000<br>
        <a href="/contact-us/">Contact Us</a>
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.6/css/froala_style.min.css' rel='stylesheet' type='text/css' />
@stop