@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="controller">
        <h1>{{$type}}</h1>
        @if($type == "wish")
            @foreach($products as $product)
                {{$product->getId()}}
            @endforeach
        @else
            @foreach($products as $product)
                {{$product->getProduct()-> getName()}}
                {{$product->getProduct()-> getPrice()}}
            @endforeach
        @endif
    </div>
@endsection