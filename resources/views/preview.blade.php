{{-- File: ./resources/views/single.blade.php --}}
    @extends('layouts.master')

    @section('content')
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h3 class="mt-4">{{ $post->title }} <span class="lead"> by <a href="#"> {{ $post->user->name }} </a></span> </h3>
          <hr>
          <p>Posted {{ $post->created_at->diffForHumans() }} </p>
          <hr>
          <img class="img-fluid rounded" src=" {!! !empty($post->image) ? '/uploads/posts/' . $post->image :  'http://placehold.it/750x300' !!} " alt="">
          <hr>
          <p class="lead">{!! $post->body !!}</p>
        </div>
      </div>
    </div>
    @endsection

    @section('scripts')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.6/css/froala_style.min.css' rel='stylesheet' type='text/css' />
@stop