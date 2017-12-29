@extends('layouts.app')

@section('content')
<div class="container" ng-controller="controller">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- write code-->
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
                                        <button ng-click="addToOrderCart('{{$product->getId()}}', '{{csrf_token()}}', '{{Auth::user()->id}}');">Add to Cart</button>
                                        like:<input type="checkbox" id="{{"like".$product->getId()}}" ng-click="addToWishCart('{{$product->getId()}}', '{{csrf_token()}}', '{{Auth::user()->id}}', '{{"like".$product->getId()}}');"/>
                                    </div>
                                </div>
                            </div>
                            </li>
                        @endforeach
                        </ul>
                </div>
                <form action="/ordercarts/15" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="1">
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
