var expressServer = require('express');
var router = expressServer.Router();
var https = require('https');
var request = require('request');


function formUrl(req,res){
    const inputCity = req.query.inputCity;
    const autocompleteURL = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input='
        + inputCity + '&types=(cities)&language=en&key=AIzaSyBfjNSPYzkff1Bk0Lqej2LIpI3fLCwULEk';
    return autocompleteURL;
}



router.get('/', function(req, res) {
   const autoCompleteURL = formUrl(req,res);
    request(autoCompleteURL, {json:true}, function (err, resp, body) {
        if (err) {
            return console.log(err);
        }
        // console.log(body.results[0]);
        res.send(body);


    });
});

module.exports = router;

