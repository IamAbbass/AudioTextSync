@extends('layouts.main')

@section('content')
<h2 style="margin-top: 12px;" class="text-center">Edit Image</a></h2>
<br>
 
<form action="{{ route('products.update', $product_info->id) }}" method="POST" name="update_product" enctype="multipart/form-data">
{{ csrf_field() }}
@method('PATCH')
 
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>Image</strong>
            @if($product_info->image)
            <img id="original" src="{{ url('image/'.$product_info->image) }}" height="70" width="70">
            @endif
            <input type="file" name="image" class="form-control" placeholder="" value="{{ $product_info->image }}">
            <span class="text-danger">{{ $errors->first('image') }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
 
</form>
@endsection