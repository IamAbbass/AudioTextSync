@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  All Audio Files
                  <a class="btn btn-primary pull-right" href="/create">{{ __('Upload Audio') }}</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Audio</th>
                          <th>Processed At</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $sno = 1;
                        @endphp
                        @foreach($audios as $audio)
                          <tr>
                            <td>{{ $sno++ }}.</td>
                            <td>{{ $audio->name ? $audio->name : 'No Story Name' }}</td>
                            <td>
                                @php
                                  $audio_path = asset('/uploads/'.$audio->audio_path);
                                @endphp
                                <audio controls>
                                  <source src="{{ $audio_path }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($audio->created_at)->calendar() }}</td>
                            <th>

                              <a href="/{{$audio->id}}" class="btn btn-primary float-left mr-2">View</a>

                              <!--
                              <a href="/edit/{{$audio->id}}" class="btn btn-warning float-left mr-2">Edit</a>
                              <form action="/destroy/{{$audio->id}}" method="post" class="float-left mr-2">
                               {{ csrf_field() }}
                               @method('DELETE')
                               <button class="btn btn-danger float-right" type="submit">Delete</button>
                              </form> -->
                            </th>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    @if(count($audios) == 0)
                      <p style="font-size:24px;" class="text-center text-muted p-4">You have not uploaded any audio files yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
