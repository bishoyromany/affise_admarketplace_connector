<?php 
/**
 * debug the content of any variable
 */
function dd(...$data){
    foreach($data as $d){
        echo "<pre>";
            var_dump($d);
        echo "</pre>";
    }
    exit;
}

/**
 * validate the get request
 */
function validate(...$data){
    foreach($data as $d){
        if(!isset($_GET[$d])){
            return "$d is Required";
        }
    }

    return true;
}

/**
 * send a post request to api
 */
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

/**
 * add http to the url if doesn't exist
 */
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/**
 * get option
 */
function getConfig($option){
    $options = json_decode(file_get_contents(__DIR__.'./../tokens.json'), true);
    $parts = explode('->',$option);
    try{
        foreach($parts as $part){
            $options = $options[$part];
        }
    }catch(\Exception $e){
        return false;
    }

    return $options;
}