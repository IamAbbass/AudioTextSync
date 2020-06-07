@extends('layouts.main')
   
@section('content')
<a href="{{ route('products.create') }}" class="btn btn-success mb-2">Add Image</a> 
  <br>
   <div class="row">
        <div class="col-12">
          
          <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>ID</th>
                 <th>Image</th>
                 <th>Action</th>
              </tr>
           </thead>
           <tbody>
              @foreach($products as $product)
              <tr>
                 <td>{{ $product->id }}</td>
                 <td>
                     <img src="{{ url('image/'.$product->image) }}" height="100" width="100">
                 </td>
                 <td>
                 <a href="{{ route('products.edit',$product->id)}}" class="btn btn-primary  float-left">Edit</a>
                 <form action="{{ route('products.destroy', $product->id)}}" method="post">
                  {{ csrf_field() }}
                  @method('DELETE')
                  <button class="btn btn-danger float-right" type="submit">Delete</button>
                </form>
                </td>
              </tr>
              @endforeach
           </tbody>
          </table>
          {!! $products->links() !!}
       </div> 
   </div>
 @endsection  