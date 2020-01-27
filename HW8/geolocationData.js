var expressServer = require('express');
var router = expressServer.Router();
var https = require('https');
var request = require('request');

function formUrl(req) {
    const lon = req.query.lon;
    const lat = req.query.lat;

    const darkSkyApiURL = 'https://api.darksky.net/forecast/1a6e3a63e040d6652a1ddbb2b9d8ae89/' + lat + "," + lon;
    return darkSkyApiURL;
}

router.get('/', function(req, res) {
    const darkSkyApiURL = formUrl(req);
    request(darkSkyApiURL, {json:true}, function (err, resp, body) {
        if (err) {
            return console.log(err);
        }

        res.send(body);
    });
});

module.exports = router;

