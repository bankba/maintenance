@extends('layouts.main')

@section('title', 'Stock Movements')

@section('content')

    @include('inventory.stocks.movements.grid.index', compact('item', 'stock'))

@stop
