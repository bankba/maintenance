@extends('maintenance::layouts.pages.main.panel')

@section('title')
<h1>{{ $title }}</h1>
@stop

@section('breadcrumb')

@stop

@section('panel.head.content')
<div class="btn-toolbar">
    <a class="btn btn-primary" href="{{ route('maintenance.assets.events.create', array($asset->id)) }}">
        <i class="fa fa-plus-circle"></i>
        New Event
    </a>
</div>
@stop

@section('panel.body.content')

@if($events->count() > 0)

    {{ 
        $events->columns(array(
                'title' => 'Title / Summary',
                'description' => 'Description',
                'all_day' => 'All Day',
                'start' => 'Start',
                'end' => 'End',
                'actions' => 'Actions',
            ))
            ->modify('start', function($record) {
                return $record->viewer()->startFormatted;
            })
            ->modify('end', function($record){
                return $record->viewer()->endFormatted;
            })
            ->modify('all_day', function($record) {
                return $record->viewer()->lblAllDay;
            })
            ->modify('actions', function($record) use($asset) {
                return $record->viewer()->btnActionsForAsset($asset);
            })
            ->render() 
    }}
            
    @else
    
    <h5>There are no events to display.</h5>
    
    @endif
    
@stop