@extends('admin.content')

@section('title') Order: {{ $order->id}} @endsection

@section('content')

<div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>product_id</th>
                            <th>order_id</th>
                            <th>price</th>
                            <th>quantity</th>



                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItem as $item )
                           
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->order_id }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                             

                               
                             
                            </tr>
                           
                        @endforeach
                    </tbody>
                </table>
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

                               
                             
                            </tr>
                           
                      
                    </tbody>
                </table>
            </div>

@endsection