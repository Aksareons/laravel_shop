<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@yield('title')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if($errors->count() > 0)
                <p>The following errors have occurred:</p>
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{$message}}</li>
                    @endforeach
                </ul>
            @endif
      
        <form action="{{route ('gallery.store') }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
                {{ Form::label('cover', 'Cover image') }}
                {{ Form::text('cover', null, ['class' => 'form-control', 'placeholder' => 'Cover Image URL']) }}
            </div>
  <label> Select Files: </label>
  <input type="file" name="fileUpload[]" multiple > 
  <input type="submit" name="Submit" value="Upload" >
</form>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>