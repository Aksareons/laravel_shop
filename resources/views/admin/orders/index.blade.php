@extends('admin.content')

@section('title') Orders @endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    <div class="mt-2">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>user_id</th>
                            <th>Name</th>
                            <th>LastName</th>
                            <th>Email</th>

                            <th>Phone</th>

                            <th>Address</th>

                            <th>comment</th>
                            <th>total</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order )
                           
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->customerName }}</td>
                                <td>{{ $order->customerLastName }}</td>
                                <td>{{ $order->customerEmail }}</td>
                                <td>{{ $order->customerPhone}}</td>
                                <td>{{ $order->customerAddress }}</td>
                                <td>{{ $order->comment }}</td>
                                <td>{{ $order->total}}$</td>

                               
                                <td>
                                    <div class="btn-group">
                                    <a href="{{ route('admin.orders.delete', ['id' => $order]) }}" class="btn btn-danger">Delete</a>

                                        <a href="{{ route('admin.orders.show', ['order' => $order]) }}" class="btn btn-success">show</a>
                                    </div>
                                </td>
                            </tr>
                           
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    
@endsection
