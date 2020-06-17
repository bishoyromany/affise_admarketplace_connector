<?php 

/**
 * include the helpers functions [dd, validate, addHttp, post]
 */
require_once "helpers.php";



if(isset($_GET['serve'])):
    /**
     * get the API tokens
     */
    $tokens = json_decode(file_get_contents(__DIR__."/../tokens.json"), true);
    /**
     * validate the get request
     */
    $validator = validate('qt', 'sub1', 'sub2', 'm-aaid');
    /**
     * check if validation success
     */
    if($validator !== true){
        echo $validator;
        exit;
    }

    /**
     * Admarketplace API
     */
    // search keyword
    $qt = $_GET['qt'];
    // sub1 single data
    $sub1 = $_GET['sub1'];
    // sub2 single check
    $sub2 = $_GET['sub2'];
    $m_aaid = $_GET['m-aaid'];
    // sub2 list
    $sub2List = $tokens['sub2'];
    // the added offers list
    $addedOffers = [];
    /**
     * check if request for a list or a single sub2
     */
    if(empty($sub2List)){
        $sub2List = [$sub2];
    }

    /**
     * loop all sub2 values to store the data for affise API
     */
    foreach($sub2List as $sub2):
        /**
         * get admarketplace offets
         */
        $admarketplace = $tokens['admarketplace'];

        $admarketplaceQuery = $admarketplace['requestAddon'];
        $admarketplaceQuery['qt'] = $qt;
        $admarketplaceQuery['sub1'] = $sub1;
        $admarketplaceQuery['sub2'] = $sub2;
        $admarketplaceQuery['m-aaid'] = $m_aaid;

        $admarketplaceUrl = $admarketplace['url'].'?'.http_build_query($admarketplaceQuery);

        $admarketplaceResponse = json_decode(file_get_contents($admarketplaceUrl));

        $ads = $admarketplaceResponse->adlistings->listing;

        /**
         * loop admarketplace offers
         */
        foreach($ads as $ad):
            /**
             * Affise API
             */
            $affise = $tokens['affise'];
            $affiseUrl = $affise['url'];
            $affiseHeaders = $affise['headers'];
            $affiseParams = $affise['requestAddon'];
            $affiseParams['title'] = $ad->title . ' - '. $sub2;
            $affiseParams['url'] = $ad->clickurl;
            $affiseParams['url_preview'] = addhttp($ad->displayurl);
            $affiseParams['status'] = 'active';
            $affiseParams['sub_account_1'] = $sub1;
            $affiseParams['sub_account_2'] = $sub2;
            $affiseParams['description_lang'] = [
                'en' => $ad->description,
            ];
            $affiseParams['external_offer_id'] = $ad->adId;

            /**
             * payment part
             * un comment only if you are going to add the payment stuff here
             */
            // $affiseParams['payments'] = [];
            // $affiseParams['payments']['country_exclude'] = false;
            // $affiseParams['payments']['countries'] = '';
            // $affiseParams['payments']['cities'] = '';
            // $affiseParams['payments']['goal'] = '';
            // $affiseParams['payments']['total'] = '';
            // $affiseParams['payments']['revenue'] = '';
            // $affiseParams['payments']['currency'] = 'usd';
            // $affiseParams['payments']['type'] = 'fixed';
            // $affiseParams['payments']['sub1'] = $sub1;
            // $affiseParams['payments']['sub2'] = $sub2;

            // send the request to affise api to store the data
            $data = post($affiseUrl, $affiseParams, $affiseHeaders);
            // add offer to the added offers
            array_push($addedOffers, $data);
        endforeach;
    endforeach;

    /**
     * show the result of added offers
     */
    dd(["offsers" => $addedOffers, "countOfAddedOffers" => count($addedOffers)]);
endif;
