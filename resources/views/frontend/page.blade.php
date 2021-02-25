@extends('layouts.site')

@section('content')
    @if (isset($item))
        <h1>{{ $item->title}}</h1>
        {!! $item->content !!}
    @else
        <h1>{{ $page->title }}</h1>
        {!! $page->content !!}
    @endif
@endsection
