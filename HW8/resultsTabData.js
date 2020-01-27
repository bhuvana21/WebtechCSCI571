var expressServer = require('express');
var router = expressServer.Router();
var https = require('https');
var request = require('request');


function formUrl(req){
    const street = req.query.streetName;
    const city = req.query.cityName;
    const state = req.query.stateName;
    const getDetailsUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=['+street+','+city+','+state +']&key=AIzaSyBfjNSPYzkff1Bk0Lqej2LIpI3fLCwULEk';
    return getDetailsUrl;
}

function callDarkSkyAPI(req,res) {


}

router.get('/', function(req, res) {
    const weatherDataURL = formUrl(req);
    request(weatherDataURL, {json:true}, function (err, resp, body) {
        if (err) {
            return console.log(err);
        }

        const darkSkyApi = 'https://api.darksky.net/forecast/1a6e3a63e040d6652a1ddbb2b9d8ae89/' + body.results[0].geometry.location.lat + "," + body.results[0].geometry.location.lng;
        request(darkSkyApi, {json: true}, function (err, resp, body) {
            if (err) {
                return console.log(err);
            }
            res.send(body);
        });


    });


});

module.exports = router;

