@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  Upload Audio
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form action="/" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <strong>Title:</strong>
                                  <input value="{{ old('name') }}" type="text" name="name" class="form-control" placeholder="Eg. Story: Alex Gets a New Car">
                                  <span class="text-danger">{{ $errors->first('name') }}</span>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <strong>Audio File: *</strong></br>
                                  <input type="file" name="audio" required>
                                  <span class="text-danger">{{ $errors->first('audio') }}</span>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <button type="submit" class="btn btn-primary">Upload</button>
                          </div>
                      </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
