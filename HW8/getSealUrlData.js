var expressServer = require('express');
var router = expressServer.Router();
var https = require('https');
var request = require('request');

function formUrl(req) {
    const stateName = req.query.stateName;

    const searchEngineID = '011782248725805539749:9pp0oqo5gib';
    const placesKey = 'AIzaSyBfjNSPYzkff1Bk0Lqej2LIpI3fLCwULEk';
    const stateSealURL = 'https://www.googleapis.com/customsearch/v1?q='
        + stateName
        +'%20State%20Seal&cx='
        + searchEngineID
        + '&imgSize=huge&imgType=news&num=1&searchType=image&key='
        + placesKey;

    return stateSealURL;
}

router.get('/', function(req, res) {
    const url = formUrl(req);
    request(url, {json:true}, function (err, resp, body) {
        if (err) {
            return console.log(err);
        }

        res.send(body);
    });
});

module.exports = router;