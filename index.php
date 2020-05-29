<?php
  ini_set('max_execution_time', 300);
  error_reporting(0);
  $url = "https://api.us-south.speech-to-text.watson.cloud.ibm.com/instances/e167c678-2188-4665-b306-96637b8cd51c/v1/recognize?timestamps=true&max_alternatives=3";
  $apikey = "z7YeOpDC16-zY09vrNgk49DhADD-YZpuLQrqtf8mVA6l";

  if($_POST['btnUpload']) {
    $username = "apikey";
    $password = $apikey;
    //$url = 'https://stream.watsonplatform.net/speech-to-text/api/v1/recognize?continuous=true&model=en-US_NarrowbandModel';
    $filename = $_FILES['voice']['name'];
    $filedata = $_FILES['voice']['tmp_name'];
    $file = fopen($filename, 'r');
    $filesize = $_FILES['voice']['size'];;
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
    $executed = curl_exec($ch);
    echo $executed;
    curl_close($ch);
    //var_dump($executed);
    exit;
  }



?>

<form method="post" name="post_form" enctype="multipart/form-data">
  <input type="file" name="voice">
  <input type="submit" name="btnUpload" value="submit">
</form>
