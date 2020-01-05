@extends('layouts.app')

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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
