@extends('layouts.main')

@section('content')
<h2 style="margin-top: 12px;" class="text-center">Add Image</a></h2>
<br>
 
<form action="{{ route('products.store') }}" method="POST" name="add_product" enctype="multipart/form-data">
{{ csrf_field() }}
 
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>Image</strong>
            <input type="file" name="image" class="form-control" placeholder="">
            <span class="text-danger">{{ $errors->first('image') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection