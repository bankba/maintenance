@extends('maintenance::layouts.pages.main.panel')

@section('panel.head.content')
    My Assigned Work Orders
@stop

@section('panel.body.content')
    @if($workOrders->count() > 0)

        {!!
            $workOrders->columns([
                'id' => 'ID',
                'status' => 'Status',
                'priority' => 'Priority',
                'subject' => 'Subject',
                'description' => 'Description',
                'category' => 'Category',
                'created_by' => 'Created By',
                'created_at' => 'Created At',
                'action' => 'Action'
            ])
            ->means('status', 'status.label')
            ->means('priority', 'priority.label')
            ->means('category', 'category.trail')
            ->means('created_by', 'user.full_name')
            ->means('description', 'limited_description')
            ->modify('action', function($workOrder) {
                return $workOrder->viewer()->btnActions();
            })
            ->sortable([
                'id',
                'status'=>'status_id',
                'priority' => 'priority_id',
                'category' => 'category_id',
                'created_by' => 'user_id',
                'subject',
                'created_at',
            ])
            ->hidden(['id', 'description', 'category', 'created_by', 'created_at'])
            ->showPages()
            ->render()
        !!}

    @else

        <h5>There are no work orders to display.</h5>

    @endif
@stop
