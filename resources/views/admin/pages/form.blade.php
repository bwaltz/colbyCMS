@extends('twill::layouts.form')

@section('contentFields')
    @formField('wysiwyg', [
        'name' => 'content',
        'label' => 'Content',
        'toolbarOptions' => ['list-ordered', 'list-unordered'],
        'placeholder' => 'Page content',
    ])
    @formField('medias', [
        'name' => 'cover',
        'label' => 'Cover image',
    ])

    @formField('block_editor', [
        'label' => 'Add stuff'
    ])
@stop
