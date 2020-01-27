var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');


var autoCompleteFetchRouter = require('./routes/autoCompletion');
var resultsDataFetchRouter  = require('./routes/resultsTabData');
var geolocationFetchRouter = require('./routes/geolocationData');
var getSealUrlFetchRouter = require('./routes/getSealUrlData');
var getDailyDataFetchRouter = require('./routes/getDailyData');

var app = express();
var port =   5000 ;

app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    next();
});

app.listen(port, function () {
    //console.log('Server running at http://localhost:' + port + '/');
})

__dirname = 'dist/myFirstApp';
app.use(express.static(__dirname));

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));



app.use('/getAutoComplete', autoCompleteFetchRouter);
app.use('/getResult',resultsDataFetchRouter );
app.use('/getResultCurrLocation', geolocationFetchRouter);
app.use('/getSealUrl' , getSealUrlFetchRouter);
app.use('/getResultDaily', getDailyDataFetchRouter);


// catch 404 and forward to error handler
app.use(function(req, res, next) {
  next(createError(404));
});





// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});



module.exports = app;
