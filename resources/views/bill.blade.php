@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="controller">
        {{$order->getTotalPrice()}}
    </div>
@endsection