@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="controller">
        <h1>{{$type}}</h1>
        @if($type == "wish")
            <ul class="products">
                @foreach($products as $product)
                    <li>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <a href="http://via.placeholder.com/150" target="_blank">
                                        <img src="http://via.placeholder.com/150" alt="Lights" style="width:100%">
                                        <div class="caption">
                                            <p>{{$product->getName()}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="products">
                @foreach($products as $product)
                    <li>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <a href="http://via.placeholder.com/150" target="_blank">
                                        <img src="http://via.placeholder.com/150" alt="Lights" style="width:100%">
                                        <div class="caption">
                                            <p>{{$product->getProduct()->getName()}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <form action="/orders" method="POST">
                {{csrf_field()}}
                <input type="submit" value="order">
            </form>
        @endif
    </div>
@endsection