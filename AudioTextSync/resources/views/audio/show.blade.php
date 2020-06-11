@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  {{ $audio->name }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>


                @php
                  $audio_path = asset(config('app.upload_path', 'uploads/').$audio->audio_path);
                  $audio_json   =  (array) json_decode($audio->json, true);
                  $word_timestamps = $audio_json['results'][0]['alternatives'][0]['timestamps'];
                  $words_count  = count($word_timestamps);

                  $size = (int) $audio->audio_size;
                  $base = log($size) / log(1024);
                  $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
                  $size = round(pow(1024, $base - floor($base)), 2) . $suffixes[floor($base)];

                @endphp

                <div class="col-md-12">
                  <div class="rows">
                    <div class="col-md-4 float-left">
                      <table class="table table-bordered table-striped">

                        <tr>
                          <th>Name</th>
                          <td>{{ $audio->name ? $audio->name : 'No Story Name' }}</td>
                        </tr>
                        <tr>
                          <th>Audio Size:</th>
                          <td>{{ $size }}</td>
                        </tr>
                        <tr>
                          <th>Audio Mime Type:</th>
                          <td>{{ $audio->audio_mime_type }}</td>
                        </tr>
                        <tr>
                          <th>Words Count:</th>
                          <td class="words_count"><span></span> Words</td>
                        </tr>
                        <!-- <tr>
                          <th>Confidence:</th>
                          <td>{{ ($audio_json['results'][0]['alternatives'][0]['confidence'])*100 }}%</td>
                        </tr> -->
                      </table>
                    </div>
                    <div class="col-md-8 float-left">
                      <audio id="story_audio" controls>
                        <source src="{{ $audio_path }}" type="audio/mpeg">
                          Your browser does not support the audio element.
                      </audio>

                      <br/>

                      <select class="playbackRate">
                        <option selected value="1.0">1.0 is normal speed</option>
                        <option value="0.5">0.5 is half speed (slower)</option>
                        <option value="2.0">2.0 is double speed (faster)</option>
                      </select>

                      <hr/>

                      <div class="word_timestamps">
                        @foreach($audio_json['results'] as $results)
                          @foreach($results['alternatives'][0]['timestamps'] as $word_timestamp)
                            <span class="ts_word" start="{{$word_timestamp[1]}}" end="{{$word_timestamp[2]}}" data-toggle="tooltip" data-placement="top" title="{{ $word_timestamp[1] }}s - {{ $word_timestamp[2] }}s ({{ ($word_timestamp[2]-$word_timestamp[1]) }}s)">{{ $word_timestamp[0] }}</span>
                          @endforeach
                        @endforeach
                      </div>

                      {{-- $audio_json['results'][0]['alternatives'][0]['transcript'] --}}

                    </div>
                  </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

    $(".words_count span").text($(".ts_word").length);

    var story_audio = $("#story_audio")[0];

    function highlight_word(current_time){
      $(".ts_word").removeClass("active");
      $(".ts_word").each(function(){
        var start = +$(this).attr('start');
        var end   = +$(this).attr('end');
        if(current_time >= start && current_time <= end){
          $(this).addClass('active');
        }
      });
    }

    var fastCallBack;
    story_audio.addEventListener("play", function(){
      fastCallBack = setInterval(function(){
        var current_time = story_audio.currentTime;
        highlight_word(current_time);
      },0.001);
    });

    story_audio.addEventListener("pause", function(){
      try{
        clearInterval(fastCallBack);
      }catch(e){}
    });

    //story_audio.addEventListener("timeupdate", function(){
      //highlight_word(current_time);
    //});

    $(".playbackRate").change(function(){
      story_audio.playbackRate = +$(".playbackRate").val();
    });

    $(".ts_word").click(function(){
      var start = +$(this).attr('start')-0.05;
      // var end   = +$(this).attr('end')+0.05;
      // var duration = (end-start)*1000;
      story_audio.currentTime = start;
      story_audio.play();
      // console.log("play");
      // setTimeout(function(){
      //   story_audio.pause();
      //   console.log("pause");
      // },duration);
    });

  });


</script>

@endsection
