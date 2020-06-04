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