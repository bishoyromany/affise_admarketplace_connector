# Affise - Admarketplace Connector Script, General Notes

## Affise Sample Offer Parameters -> No Payment
```php
    $affiseParams = $affise['requestAddon'];
    $affiseParams['title'] = $ad->title;
    $affiseParams['url'] = $ad->clickurl;
    $affiseParams['url_preview'] = addhttp($ad->displayurl);
    $affiseParams['status'] = 'active';
    $affiseParams['sub_account_1'] = $sub1;
    $affiseParams['sub_account_2'] = $sub2;
    $affiseParams['description_lang'] = [
        'en' => $ad->description,
    ];
    $affiseParams['external_offer_id'] = $ad->adId; 
```

## Affise Sample Offer Parameters -> With Payment
```php
    $affiseParams = $affise['requestAddon'];
    $affiseParams['title'] = $ad->title;
    $affiseParams['url'] = $ad->clickurl;
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
```

## Affise Payment Structure
* partners ❋ - Array of partner ID, which include payments (It’s available only for personal payments)
* countries - An array of countries in ISO format (or put empty string to clear existing items)
* country_exclude - Exclude these countries
* cities - An array of id cities (or put empty string to clear existing items)
* devices - The array of devices. Possible values: mediahub, mobile, ereader, console, tv, tablet, desktop, smartwatch (or put empty string to clear existing items)
* os - Possible values (or put empty string to clear existing items)
* goal - Value targets
* total - The amount of payment
* revenue - Payment webmaster
* currency ❋ - Currency (Code in ECB format)
* type ❋ - Type of payment
* Possible values: fixed, percent
* sub1 … subN - Comma-separated sub values. N is number in range 1..8. Example: sub1=subVal1,subVal2