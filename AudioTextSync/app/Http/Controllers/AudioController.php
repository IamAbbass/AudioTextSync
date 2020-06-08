<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $audios = Audio::where('user_id',auth()->id())->get();
        return view('audio.list',[
          'audios' => $audios,
        ]);
    }

    public function create()
    {
      return view('audio.create');
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', 300);
        $url = "https://api.us-south.speech-to-text.watson.cloud.ibm.com/instances/e167c678-2188-4665-b306-96637b8cd51c/v1/recognize?timestamps=true&max_alternatives=3";
        $apikey = "z7YeOpDC16-zY09vrNgk49DhADD-YZpuLQrqtf8mVA6l";

        $username = "apikey";
        $password = $apikey;
        //$url = 'https://stream.watsonplatform.net/speech-to-text/api/v1/recognize?continuous=true&model=en-US_NarrowbandModel';
        $filename = $_FILES['audio']['name'];
        $filedata = $_FILES['audio']['tmp_name'];
        $filesize = $_FILES['audio']['size'];
        $bytes = 10000;
        //D:\xampp\htdocs\zed\AudioTextSync\audio

        $type =  mime_content_type($filedata);

        // echo $filename."<Br/>";
        // echo $filedata."<Br/>";
        // echo $filesize."<br/>";
        // echo $type."</br>";

        $post = array(
        "file" =>
        curl_file_create($filedata,$type,$filename)
        );

        $data = array('part_content_type' => $type);
        $headers = array("Content-Type: $type", "Transfer-Encoding: chunked");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $text_json = curl_exec($ch);
        curl_close($ch);


        $request->validate([
            'audio' => 'required|mimes:mpeg,flac,mpga|max:5120',
        ]);
        $insert = array();
        $insert['audio_size'] = $request->file('audio')->getSize();
        $insert['audio_mime_type'] = $request->file('audio')->getMimeType();

        if ($files = $request->file('audio')) {
           $destinationPath = public_path('uploads/'); // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $insert['audio_path'] = "$profileImage";
        }
        $insert['name'] = request('name');
        $insert['json'] = $text_json;
        $insert['user_id'] = auth()->id();
        Audio::create($insert);
        return redirect('/')
        ->with('status','Success! Audio file uploaded successfully.');
    }

    public function show($id)
    {
        $audio = Audio::findOrFail($id);

        return view('audio.show',[
          'audio' => $audio,
        ]);
    }

    public function show_json($id)
    {
        $audio = Audio::findOrFail($id);
        return $audio->json;
    }



    public function edit(Audio $audio)
    {
        //
    }

    public function update(Request $request, Audio $audio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audio $audio)
    {
        //
    }
}
