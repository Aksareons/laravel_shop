@extends('admin.content')

@section('title') Products @endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    <div class="mt-2">
                        <a href="{{ route('gallery.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product_id</th>
                            <th>Photo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $gallery )
                           
                            <tr>
                                <td>{{ $gallery->id }}</td>
                                <td>{{ $gallery->product_id }}</td>
                                @foreach(json_decode($gallery->photos) as $item)
                                <td>{{ $item }}</td>
                                @endforeach
                               
                                <td>
                                    <div class="btn-group">
                                    <a href="{{ route('gallery.delete', ['id' => $gallery]) }}" class="btn btn-danger">Delete</a>

                                    <a href="{{ route('gallery.edit', ['gallery' => $gallery->getKey()]) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('gallery.show', ['gallery' => $gallery->getKey()]) }}" class="btn btn-success">show</a>
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
