var expressServer = require('express');
var router = expressServer.Router();
var request = require('request');

function formUrl(req) {
    const time = req.query.time;
    const longitude = req.query.lon;
    const latitude = req.query.lat;

    const darkSkyApiURL = 'https://api.darksky.net/forecast/1a6e3a63e040d6652a1ddbb2b9d8ae89/' + latitude + ',' + longitude + ',' + time;
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