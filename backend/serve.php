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

    /**
     * Admarketplace API
     */

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


    /**
     * Affise API
     */

    $affise = $tokens['affise'];
    $affiseUrl = $affise['url'];
    $affiseParams = $affise['requestAddon'];
    $affiseHeaders = $affise['headers'];

    // title=test&advertiser=573c69a33b7d9b0e638b4576&url=http://example.com&url_preview=http://preview.example.com
    // $affiseParams['title'] = 'testOffser';
    // $affiseParams['advertiser'] = '573c69a33b7d9b0e638b4576';
    // $affiseParams['url'] = 'http://example.com';
    // $affiseParams['url_preview'] = 'http://preview.example.com';

    $affiseParams['hide_payments'] = false;
    $affiseParams['title'] = 'This is a test offer';
    $affiseParams['macro_url'] = null;
    $affiseParams['url'] = 'http://affise.com';
    $affiseParams['cross_postback_url'] = 'http://test-url.com';
    $affiseParams['url_preview'] = 'http://preview.affise.com';
    $affiseParams['preview_url'] = 'http://preview.affise.com';
    $affiseParams['domain_url'] = 'affise.tds';
    $affiseParams['use_https'] = false;
    $affiseParams['use_http'] = true;
    $affiseParams['description_lang'] = [
        'ru' => 'Описание',
        'en' => 'Description'
    ];
    $affiseParams['sources'] = [];
    $affiseParams['logo'] = '/images/cpa/logos/';
    $affiseParams['status'] = 'stopped';
    $affiseParams['tags'] = ['default'];
    $affiseParams['privacy'] = 'public';
    $affiseParams['is_top'] = 0;
    $affiseParams['payments'] = [];
    $affiseParams['partner_payments'] = [];
    $affiseParams['landings'] = [];
    $affiseParams['strictly_country'] = 0;
    $affiseParams['strictly_os'] = [];
    $affiseParams['strictly_connection_type'] = 'wi-fi';
    $affiseParams['is_redirect_overcap'] = false;
    $affiseParams['notice_percent_overcap'] = null;
    $affiseParams['hold_period'] = 0;
    $affiseParams['categories'] = [];
    $affiseParams['full_categories'] = [];
    $affiseParams['cr'] = 0;
    $affiseParams['epc'] = 0;
    $affiseParams['notes'] = null;
    $affiseParams['allowed_ip'] = '';
    $affiseParams['hash_password'] = null;
    $affiseParams['allow_deeplink'] = 0;
    $affiseParams['hide_referer'] = 0;
    $affiseParams['start_at'] = "2019-06-17 12:35:00";
    $affiseParams['stop_at'] = null;
    $affiseParams['auto_offer_connect'] = null;
    $affiseParams['required_approval'] = false;
    $affiseParams['is_cpi'] = false;
    $affiseParams['creatives'] = [];
    $affiseParams['creatives_zip'] = null;
    $affiseParams['smartlink_categories'] = ["595e3b5b7e28fede7b8b456d"];
    $affiseParams['click_session'] = "1y";
    $affiseParams['minimal_click_session'] = "0s";
    $affiseParams['external_offer_id'] = "this_is_my_test_id";
    $affiseParams['sub_restrictions'] = [
        'sub1' => 'first_sub_value',
        'sub2' => 'second_sub_value'
    ];
    $affiseParams['caps_timezone'] = "Europe/Moscow";
    $affiseParams['strictly_isp'] = ['595e3b5b7e28fede7b8b456d'];
    $affiseParams['note_aff'] = "";
    $affiseParams['note_sales'] = "";
    $affiseParams['disallowed_ip'] = "";
    $affiseParams['hide_caps'] = 0;
    $affiseParams['caps_status'] = ['confirmed'];
    $affiseParams['caps_goal_overcap'] = "install";
    $affiseParams['commission_tiers'] = [
        'affiliates' => [1],
        'goal' => [],
        'timeframe' => 'month',
        'type' => 'budget',
        'value' => 0.5,
        'target_goals' => [],
        'modifier_type' => 'to_percent',
        'modifier_value' => 10.02
    ];

    // dd($affiseParams);

    $data = post($affiseUrl, $affiseParams, $affiseHeaders);

    dd($data);

endif;
