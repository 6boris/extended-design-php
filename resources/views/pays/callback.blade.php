@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Show Order
                        <a href="{{ URL('orders') }}" class="btn btn-success float-right">List</a>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            Pay Successd
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
