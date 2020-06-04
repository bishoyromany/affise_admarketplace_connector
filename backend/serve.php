<?php 

require_once "helpers.php";



if(isset($_GET['serve'])):
    $tokens = json_decode(file_get_contents(__DIR__."/../tokens.json"), true);

    // out     = json
    // qt      = tiktok
    // results = 1
    // v       = 7
    // ip      = 96.41.207.187
    // ua      = Mozilla/5.0 (Linux; Android 8.0.0; SM-G960F Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36
    // partner = trendqubeals
    // sub1    = tiktok
    // sub2    = com.chess
    // m-aaid  = a39404a7-59cb-4352-8501-458d7da59ae2
    // rfr     = https://play.google.com/store/apps/details?id=com.chess

    $validator = validate('qt', 'sub1', 'sub2', 'm-aaid');

    if($validator !== true){
        echo $validator;
        exit;
    }

    $qt = $_GET['qt'];
    $sub1 = $_GET['sub1'];
    $sub2 = $_GET['sub2'];
    $m_aaid = $_GET['m-aaid'];

    $admarketplace = $tokens['admarketplace'];

    $admarketplaceQuery = $admarketplace['requestAddon'];
    $admarketplaceQuery['qt'] = $qt;
    $admarketplaceQuery['sub1'] = $sub1;
    $admarketplaceQuery['sub2'] = $sub2;
    $admarketplaceQuery['m-aaid'] = $m_aaid;

    $admarketplaceUrl = $admarketplace['url'].'?'.http_build_query($admarketplaceQuery);

    $admarketplaceResponse = json_decode(file_get_contents($admarketplaceUrl));

    dd($admarketplaceResponse);

endif;