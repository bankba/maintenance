@extends('layouts.pages.main.panel')

@section('title', "Create a $resource")

@section('panel.head.content')
    Create {{ $resource }}
@stop

@section('panel.body.content')
    {!!
        Form::open([
            'url' => route($routes['store']),
            'class' => 'form-horizontal'
        ])
    !!}

    @include('categories.form')

    {!! Form::close() !!}
@stop
