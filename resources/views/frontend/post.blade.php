@extends('layouts.site')

@section('content')
    @if (isset($item))
        <h1>{{ $item->title}}</h1>
        {!! $item->content !!}
    @else
        <h1>{{ $post->title }}</h1>
        {!! $post->content !!}
    @endif
@endsection
