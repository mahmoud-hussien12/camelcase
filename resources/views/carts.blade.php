@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="controller">
        <div class="row">
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="/ordercarts/{{Auth::user()->id}}">
                        <img src="/imgs/cart.jpg" alt="Lights" style="width:100%">
                        <div class="caption">
                            <p>Order Cart</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="/wishcarts/{{Auth::user()->id}}">
                    <img src="/imgs/cart.jpg" alt="Lights" style="width:100%">
                    <div class="caption">
                        <p>wish Cart</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection