# Affise - Admarketplace Connector Script, General Notes

## To use this script you should do the following.
* install apache server and a php version >= 7.*
* rename .tokens.json file to tokens.json

## How to edit the APIs tokens and URLs
1. open tokens.json after renaming it, you'll see this 
    ```json
    {
        "admarketplace": {
            "url": "http://trendqube.ampfeed.com/xmlamp/feed",
            "requestAddon": {
                "partner": "partner name",
                "ip": "request api",
                "ua": "Mozilla/5.0 (Linux; Android 8.0.0; SM-G960F Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36",
                "v": 7,
                "out": "json",
                "results": 20
            }
        },
        "affise": {
            "url": "https://api-trendqube.affise.com/3.0/admin/offer",
            "requestAddon": {
                "advertiser": "advertiser id"
            },
            "headers": [
                "API-Key: api login key"
            ]
        },
        "sub2": [
            "sub2 list not required"
        ]
    }
    ```
2. let's descript this json data 
    1. admarketplace -> url [the url of admarketplace, where script will get offers from it].
    2. admarketplace -> url -> requestAddon -> partner [the partner name for example "trendqube"]
    3. admarketplace -> url -> requestAddon -> ip [the request user api write any ip address if you want]
    4. affise -> url [the url of affist api, where the script can add the offer]
    5. affise -> requestAddon -> advertiser [the advertiser id, where the offer will be stored for that advertiser]
    6. affise -> headers [here you'll add the api key of affise api]
    7. sub2 [it's a list of sub2 values for admarketplace, it's not required at all]
3. after completing editing the tokens.json file, now you can open the api connector form in the web using browser
4. after opening the form in the browser you'll see with a couple of inputs, let's take them one by one.
    1. QT: this is the search keyword for admarketplace, it's always like sub1 value i guess
    2. sub1: this is the offer owner or advertiser
    3. sub2: here you can add as much sub2 values as you need by click the plus icon, and you can remove sub2 values as much as you need by clicking the remove or X icon behind the input
    4. m-aaid: it's for admarketplace related to if the offer was opened using mobile
    5. start script: this will run the script progress, and add the offers

## for technical stuff check our this https://github.com/bishoyromany/affise_admarketplace_connector/blob/master/tech.md