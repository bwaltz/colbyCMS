@extends('layouts.frontend-layout')

@section('title', 'Posts')

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

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section  text-center">
            <h2 class="mb-4">Posts</h2>
          </div>
        </div>
        <div class="row d-flex">
        @if(count($posts))
            @foreach ($posts as $post)
              <div class="col-md-4 d-flex ">
                <div class="blog-entry align-self-stretch">
                @if(!empty($post->image))
                  <a href="/post/{{ $post->slug }}" class="block-20" style="background-image: url('{!! '/storage/uploads/' . $post->image !!}');">
                  </a>
                @else
                <a href="/post/{{ $post->slug }}" class="block-20" style="background-image: url('{!! 'images/default.png' !!}');">
                  </a>
                @endif
                  <div class="text p-4 d-block">
                    <div class="meta mb-3">
                      <div><a href="#">{{ $post->created_at->diffForHumans() }}</a></div>
                      <div><a href="#"{{ $post->user->name }}</a></div>
                    </div>
                    <h3 class="heading mt-3"><a href="/post/{{ $post->slug }}">{{ $post->title }}</a></h3>
                    <p>{!! str_limit($post->body, $limit = 280, $end = '...') !!}</p>
                    <a href="/post/{{ $post->slug }}" class="btn btn-default">Read More &rarr;</a>
                  </div>
                </div>
              </div>
            @endforeach
        @else
          <div style="margin-bottom: 3em">No posts</div>
        @endif
        </div>
      </div>
    </section>
		
		<section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white ">
              <h2>Subcribe to our Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
              <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-8">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection