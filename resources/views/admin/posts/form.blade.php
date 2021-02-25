@extends('twill::layouts.form')

@section('contentFields')
    @formField('wysiwyg', [
        'name' => 'content',
        'label' => 'Content',
        'toolbarOptions' => ['list-ordered', 'list-unordered'],
        'placeholder' => 'Post content',
    ])

    @formField('input', [
        'name' => 'video',
        'label' => 'Featured Video',
        'maxlength' => 100,
        'note' => 'Vimeo or Youtube URL',
    ])

    @include('admin.blocks.example', [
        'label' => 'Categories',
        'name' => 'categories',
        'max' => 15,
        'moduleName' => 'categories'
    ])

    <!-- @formField('browser', [
    'label' => 'Categories',
    'max' => 15,
    'name' => 'categories',
    'moduleName' => 'categories'
]) -->

    @formField('medias', [
        'name' => 'cover',
        'label' => 'Cover image',
    ])


@stop


