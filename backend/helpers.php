<?php 
function dd(...$data){
    foreach($data as $d){
        echo "<pre>";
            var_dump($d);
        echo "</pre>";
    }
    exit;
}


function validate(...$data){
    foreach($data as $d){
        if(!isset($_GET[$d])){
            return "$d is Required";
        }
    }

    return true;
}

function post($url, $data, $headers){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}