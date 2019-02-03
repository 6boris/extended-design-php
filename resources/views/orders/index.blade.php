@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Order List
                        <a href="{{ URL('orders/create') }}" class="btn btn-success float-right">Create</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Num</th>
                                <th scope="col">Account</th>
                                <th scope="col">User</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Finised_at</th>
                                <th scope="col">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th>{{ $order->id }}</th>
                                    <th>{{ $order->order_num }}</th>
                                    <td>{{ $order->account }}</td>
                                    <th>{{ $order->name }}</th>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->finised_at }}</td>
                                    <td align="center">
                                        <a href="{{ URL('orders') .'/'. $order->id  }}" class="btn btn-primary">Show</a>
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
