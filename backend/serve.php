<?php 

require_once "helpers.php";



if(isset($_GET['serve'])):
    $tokens = json_decode(file_get_contents(__DIR__."/../tokens.json"), true);

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

    $ads = $admarketplaceResponse->adlistings->listing;

    // dd($ads);
    foreach($ads as $ad):
        /**
         * Affise API
         */
        $affise = $tokens['affise'];
        $affiseUrl = $affise['url'];
        $affiseHeaders = $affise['headers'];
        $affiseParams = $affise['requestAddon'];

        // title=test&advertiser=573c69a33b7d9b0e638b4576&url=http://example.com&url_preview=http://preview.example.com
        $affiseParams['title'] = $ad->title;
        $affiseParams['url'] = $ad->clickurl;
        // $affiseParams['domain_url'] = $ad->clickurl;
        $affiseParams['url_preview'] = addhttp($ad->displayurl);
        $affiseParams['status'] = 'active';
        $affiseParams['sub_account_1'] = $sub1;
        $affiseParams['sub_account_2'] = $sub2;
        $affiseParams['description_lang'] = [
            'en' => $ad->description,
        ];
        $affiseParams['external_offer_id'] = $ad->adId;

        // payment
        $affiseParams['payments'] = [];
        $affiseParams['payments']['country_exclude'] = false;
        $affiseParams['payments']['countries'] = '';
        $affiseParams['payments']['cities'] = '';
        $affiseParams['payments']['goal'] = '';
        $affiseParams['payments']['total'] = '';
        $affiseParams['payments']['revenue'] = '';
        $affiseParams['payments']['currency'] = 'usd';
        $affiseParams['payments']['type'] = 'fixed';
        $affiseParams['payments']['sub1'] = $sub1;
        $affiseParams['payments']['sub2'] = $sub2;

        // "payments":[
        //     {
        //        "countries":[
   
        //        ],
        //        "cities":[
   
        //        ],
        //        "devices":[
   
        //        ],
        //        "os":[
   
        //        ],
        //        "goal":"1",
        //        "total":0,
        //        "revenue":0,
        //        "currency":"usd",
        //        "title":"",
        //        "type":"fixed",
        //        "url":null,
        //        "country_exclude":false,
        //        "with_regions":false,
        //        "sub1":null,
        //        "sub2":null,
        //        "sub3":null,
        //        "sub4":null,
        //        "sub5":null,
        //        "sub6":null,
        //        "sub7":null,
        //        "sub8":null
        //     }
        //  ],

        dd($affiseParams);

        // dd($affiseParams);

        // $affiseParams['hide_payments'] = false;
        // $affiseParams['title'] = 'This is a test offer';
        // $affiseParams['macro_url'] = null;
        // $affiseParams['url'] = 'http://affise.com';
        // $affiseParams['cross_postback_url'] = 'http://test-url.com';
        // $affiseParams['url_preview'] = 'http://preview.affise.com';
        // $affiseParams['preview_url'] = 'http://preview.affise.com';
        // $affiseParams['domain_url'] = 'affise.tds';
        // $affiseParams['use_https'] = false;
        // $affiseParams['use_http'] = true;
        // $affiseParams['description_lang'] = [
        //     'ru' => 'Описание',
        //     'en' => 'Description'
        // ];
        // $affiseParams['sources'] = [];
        // $affiseParams['logo'] = '/images/cpa/logos/';
        // $affiseParams['status'] = 'stopped';
        // $affiseParams['tags'] = ['default'];
        // $affiseParams['privacy'] = 'public';
        // $affiseParams['is_top'] = 0;
        // $affiseParams['payments'] = [];
        // $affiseParams['partner_payments'] = [];
        // $affiseParams['landings'] = [];
        // $affiseParams['strictly_country'] = 0;
        // $affiseParams['strictly_os'] = [];
        // $affiseParams['strictly_connection_type'] = 'wi-fi';
        // $affiseParams['is_redirect_overcap'] = false;
        // $affiseParams['notice_percent_overcap'] = null;
        // $affiseParams['hold_period'] = 0;
        // $affiseParams['categories'] = [];
        // $affiseParams['full_categories'] = [];
        // $affiseParams['cr'] = 0;
        // $affiseParams['epc'] = 0;
        // $affiseParams['notes'] = null;
        // $affiseParams['allowed_ip'] = '';
        // $affiseParams['hash_password'] = null;
        // $affiseParams['allow_deeplink'] = 0;
        // $affiseParams['hide_referer'] = 0;
        // $affiseParams['start_at'] = "2019-06-17 12:35:00";
        // $affiseParams['stop_at'] = null;
        // $affiseParams['auto_offer_connect'] = null;
        // $affiseParams['required_approval'] = false;
        // $affiseParams['is_cpi'] = false;
        // $affiseParams['creatives'] = [];
        // $affiseParams['creatives_zip'] = null;
        // $affiseParams['smartlink_categories'] = ["595e3b5b7e28fede7b8b456d"];
        // $affiseParams['click_session'] = "1y";
        // $affiseParams['minimal_click_session'] = "0s";
        // $affiseParams['external_offer_id'] = "this_is_my_test_id";
        // $affiseParams['sub_account_1'] = 'first_sub_value';
        // $affiseParams['sub_account_2'] = 'second_sub_value';
        // // $affiseParams['sub_restrictions'] = [
        // //     'sub1' => 'first_sub_value',
        // //     'sub2' => 'second_sub_value'
        // // ];
        // $affiseParams['caps_timezone'] = "Europe/Moscow";
        // $affiseParams['strictly_isp'] = ['595e3b5b7e28fede7b8b456d'];
        // $affiseParams['note_aff'] = "";
        // $affiseParams['note_sales'] = "";
        // $affiseParams['disallowed_ip'] = "";
        // $affiseParams['hide_caps'] = 0;
        // $affiseParams['caps_status'] = ['confirmed'];
        // $affiseParams['caps_goal_overcap'] = "install";
        // $affiseParams['commission_tiers'] = [
        //     'affiliates' => [1],
        //     'goal' => [],
        //     'timeframe' => 'month',
        //     'type' => 'budget',
        //     'value' => 0.5,
        //     'target_goals' => [],
        //     'modifier_type' => 'to_percent',
        //     'modifier_value' => 10.02
        // ];

        // dd($affiseParams);

        $data = post($affiseUrl, $affiseParams, $affiseHeaders);

        dd($data);
    endforeach;
endif;
