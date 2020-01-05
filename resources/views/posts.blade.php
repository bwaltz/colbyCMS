{{-- File: ./resources/views/landing.blade.php --}}
    @extends('layouts.master')

    @section('content')
    <div class="container">
    @if($settings['emergency']->isEmergency)
        <div class="row" style="margin-top: 20px">
          <div class="col-lg-12">
            <div class="alert alert-danger" role="alert">
              {{ $settings['emergency']->emergencyHeader }}
            </div>
          </div>
        </div>
    @endif
      <div class="row">
        <div class="col-md-12">
          <h1 class="my-4">Welcome to ColbyCMS </h1>

          @if(count($posts))
          @foreach ($posts as $post)
          <div class="card mb-4">
          @if(!empty($post->image))
              <img class="card-img-top" src=" {!! '/storage/uploads/' . $post->image !!} " alt="Card image cap">
          @endif
            <div class="card-body">
              <h2 class="card-title text-center">{{ $post->title }}</h2>
              <p class="card-text"> {!! str_limit($post->body, $limit = 280, $end = '...') !!} </p>
              <a href="/post/{{ $post->slug }}" class="btn btn-default">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted {{ $post->created_at->diffForHumans() }} by
              <a href="#">{{ $post->user->name }} </a>
            </div>
          </div>
          @endforeach
          @else
          <div style="margin-bottom: 3em">No posts</div>
          @endif
        </div>
      </div>
    </div>
    @endsection