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
          <h1 class="my-4">Welcome to ColbyCMS</h1>
        </div>
      </div>
    </div>
    @endsection