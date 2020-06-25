<?php 

/**
 * include the helpers functions [dd, validate, addHttp, post]
 */
require_once "helpers.php";
require_once "DB.php";

if(!isLogged()):
    echo '<div class="alert alert-warning">You are not allowed to view this page</div>';
    exit;
endif;

if(isset($_GET['serve'])):
    $isTest = true;

    /**
     * get the API tokens
     */
    $tokens = json_decode(file_get_contents(__DIR__."/../tokens.json"), true);
    /**
     * validate the get request
     */
    $validator = validate('sub1', 'sub2', 'm-aaid');
    /**
     * check if validation success
     */
    if($validator !== true){
        echo $validator;
        exit;
    }  

    $db = new DB();
    $prefix = $db->getPrefix();

    /**
     * Admarketplace API
     */
    // search keyword
    // $qt = $_GET['qt'];
    // referrer
    $rfr = isset($_GET['rfr']) ? $_GET['rfr'] : '';
    // sub1 single data
    $sub1 = $_GET['sub1'];
    $fakeSub1 = isset($_GET['fakeSub1']) ? $_GET['fakeSub1'] : $sub1;
    // sub2 list
    $sub2 = json_decode($_GET['sub2']);
    // m-aaid for admarketplace api
    $m_aaid = $_GET['m-aaid'];
    // sub2 list from the json file
    $sub2List = $tokens['sub2'];
    // the added offers list
    $addedOffers = [];
    
    /**
     * check if request for sub1 from the json file or from the ui form
     */
    if(empty($sub2List)){
        $sub2List = $sub2;
    }

    /**
     * loop all sub2 values to store the data for affise API
     */
    foreach($sub2List as $sub2):
        /**
         * get admarketplace offers
         */
        $admarketplace = $tokens['admarketplace'];

        $admarketplaceQuery = $admarketplace['requestAddon'];
        // qt disabled to tile feed
        // $admarketplaceQuery['qt'] = $qt;
        $admarketplaceQuery['rfr'] = $rfr;
        $admarketplaceQuery['sub1'] = $sub1;
        $admarketplaceQuery['sub2'] = $sub2;
        $admarketplaceQuery['m-aaid'] = $m_aaid;

        $admarketplaceUrl = $admarketplace['url'].'?'.http_build_query($admarketplaceQuery);

        $admarketplaceResponse = json_decode(file_get_contents($admarketplaceUrl));
        $ads = $admarketplaceResponse->tiles;

        /**
         * loop admarketplace offers
         */
        foreach($ads as $ad):
            // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            // sub1 VARCHAR(30) NOT NULL,
            // sub2 VARCHAR(30) NOT NULL,
            // sub1Fake VARCHAR(30) NOT NULL,
            // url TEXT NOT NULL,
            // name VARCHAR(150) NOT NULL,
            // impression_url VARCHAR(150) NOT NULL,
            // ad_id INT(11) NOT NULL,
            // click_url VARCHAR(150) NOT NULL,
            // image_url VARCHAR(150) NOT NULL)

            /**
             * store data ad
             */
            $storeAd = $db->query("INSERT INTO `".$prefix."adm` 
            (sub1, sub2, sub1Fake, ad_id, url, name, impression_url, click_url, image_url) 
            VALUES('$sub1', '$sub2', $fakeSub1, $ad->id, '$admarketplaceUrl', '$ad->name', '$ad->impression_url', '$ad->click_url', '$ad->image_url')");

            /**
             * Affise API
             */
            $affise = $tokens['affise'];
            $affiseUrl = $affise['url'];
            $affiseHeaders = $affise['headers'];
            $affiseParams = $affise['requestAddon'];
            $affiseParams['title'] = $ad->name . ' - ' . $ad->id . ' - ' . $sub2;
            $affiseParams['url'] = $ad->click_url;
            // $affiseParams['url_preview'] = addhttp($ad->impression_url);
            $affiseParams['status'] = 'active';
            $affiseParams['sub_account_1'] = $fakeSub1;
            $affiseParams['sub_account_2'] = $sub2;
            $affiseParams['allow_impressions'] = 1;
            $affiseParams['notes'] = $ad->impression_url;
            $affiseParams['external_offer_id'] = $ad->id;
            /**
             * no description exist in the new api
             */
            // $affiseParams['description_lang'] = [
            //     'en' => $ad->description,
            // ];

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

            if($isTest){
                $data = json_encode(['id' => 1111]);
            }else{
                // send the request to affise api to store the data
                $data = post($affiseUrl, $affiseParams, $affiseHeaders);
            }
 
            // add offer to the added offers
            array_push($addedOffers, $data);
            
            $storeOffer = $db->query("INSERT INTO `".$prefix."affise` 
            (sub1, sub2, sub1Fake, ad_id, title, 
            impression_url, click_url, image_url, 
            offer_id, offer, adm_id) 
            VALUES('$sub1', '$sub2', $fakeSub1, $ad->id, '".$affiseParams['title']."', 
            '$ad->impression_url', '$ad->click_url', '$ad->image_url', 
            ".json_decode($data)->id.", '$data', $storeAd)");
        endforeach;
    endforeach;

    /**
     * show the result of added offers
     */
    echo "<button><a href='".getConfig('base')."'>Go Back<a/></button>";

    dd(["addedOffsers" => $addedOffers, "countOfAddedOffers" => count($addedOffers)]);


endif;
