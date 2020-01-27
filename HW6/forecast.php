<html>

<head>
    <title>Weather Summary</title>
    <style>
    body {
            text-align: center;
        }
        
        #locationForm {
            color: white;
            line-height: 1.7;
            margin-left: 45px;
            text-align: left;
        }
        
        .locationFormDiv {
            margin-top: 10px;
            border-radius: 10px;
            background: #32ab39;
            text-align: center;
            display: inline-block;
            color: white;
            font-family: Times;
            font-size: 17px;
            font-weight: 300;
            width: 700px;
            height: 250px;
        }
        
        input {
            margin-left: 4px;
        }
        
        h1,
        #locationForm {
            margin-top: 0px;
            margin-bottom: 0px;
        }
        
        .vl {
            border-left: 5px solid white;
            height: 135px;
        }
        
        #displayError {
            background-color: #e6e6e6;
            border: 1px solid black;
            text-align: center;
            height: 30px;
            width: 400px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            font-size: 24px;
        }
        
        #dispTable {
            margin-top: 20px;
            border-radius: 14px;
            background: #5cc3f3;
            display: inline-block;
            color: white;
            text-align: left;
            width: 400px;
            height: 270px;
            font-weight: bold;
        }
        
        #userLoc,
        #timeZone {
            line-height: 0.2;
        }
        
        #userLoc {
            font-size: 30px;
        }
        
        #timeZone {
            font-weight: 200;
            font-size: 13px;
        }
        
        #userLoc,
        #timeZone,
        #summary {
            margin-left: 15px;
        }
        
        #temperature {
            line-height: 0;
            font-size: 90px;
            margin-top: -23px;
            margin-left: -10px;
        }
        
        #summary {
            line-height: 0.1;
            margin-top: 11px;
        }
        
        .eachIcon {
            float: left;
            width: 16.66%;
            margin-bottom: 10px;
            display: inline-block;
            text-align: center;
        }
        /* Clearfix (clear floats) */
        
        #icons::after {
            content: "";
            clear: both;
            display: table;
            text-align: center;
        }
        
        #icons {
            margin-top: 30px;
        }
        
        table {
            border: 1px solid #1888ac;
            background-color: #94caf2;
            color: white;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            font-weight: bold;
        }
        
        table th {
            border: 1px solid #1888ac;
        }
        
        table td {
            height: 50%;
            border: 1px solid #1888ac;
        }
        
        .summaryLink {
            text-decoration: none;
            color: white;
        }
        
        #dummydispCardDummt {
            text-align: center;
        }
        
        #cardSummary {
            text-align: left;
            display: inline-block;
            background-color: #a7d0d9;
            border-radius: 14px;
            width: 530px;
            height: 460px;
            margin-top: 10px;
            font-weight: bold;
        }
        
        .summ {
            color: White;
            font-size: 30px;
            margin-left: 25px;
            margin-top: 25px;
            height: 20px;
        }
        
        #showGraph {
            background: red;
        }
        
        #imgSumm {
            float: right;
            /*            margin-top: -170px;*/
            height: 200px;
            width: 200px;
        }
        
        #data {
            color: white;
            width: 100%;
            margin-top: 150px;
        }
        
        #tempdegree {
            margin-bottom: 25px;
            margin-left: 10px;
            margin-top: 20px;
        }
        
        #tempdegreeF {
            margin-bottom: 50px;
        }
        
        .upper {
            width: 50%;
            float: left;
        }
        
        .labels {
            display: inline-block;
            /* text-align: right; */
            margin-top: -50px;
            margin-left: 155px;
            line-height: 1.7;
            font-size: 22px;
        }
        
        #result {
            font-size: 33px;
        }
        
        #chart_div {
            margin-left: auto;
            margin-right: auto;
            width: 800px;
        }
        
        #cityValue {
            margin-left: 5px;
        }
    }
    </style>
</head>

<body>
    <br>
    <br>
    <div class="locationFormDiv">
        <h1><i>Weather Search</i></h1>
        <form id="locationForm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>" onsubmit="return validateLocation()"> <span style="float: right;clear: both;margin-right: 320px;">
                <div class="vl"></div></span> <span style="float: right;clear: both;margin-right:60px;margin-top:-130px">
                <input type="checkbox" name="locationOn" id="currentLoc"  value='' <?php if(isset($_POST['locationOn'])) echo "checked='checked'"; ?> >Current Location</span>
            <br>Street
            <input type="text" id="streetValue" name="street" value="<?php echo isset($_POST['street']) ? $_POST['street'] : '' ?>">
            <br> City &nbsp;
            <input type="text" id="cityValue" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>">
            <br> State &nbsp;
            <select name="selectDropdown" id="dropdown" style="width:35%; margin-left: -5px;">
                <option value="default" selected> State</option>
                <option value="" disabled="disabled">-----------------------------------------</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='AL' ) ? 'selected="selected"' : ''; ?> value="AL">Alabama</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='AK' ) ? 'selected="selected"' : ''; ?> value="AK">Alaska</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='AZ' ) ? 'selected="selected"' : ''; ?> value="AZ">Arizona</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='AR' ) ? 'selected="selected"' : ''; ?> value="AR">Arkansas</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='CA' ) ? 'selected="selected"' : ''; ?> value="CA" >California</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='CO' ) ? 'selected="selected"' : ''; ?> value="CO">Colorado</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='CT' ) ? 'selected="selected"' : ''; ?> value="CT">Connecticut</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='DE' ) ? 'selected="selected"' : ''; ?> value="DE">Delaware</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='DC' ) ? 'selected="selected"' : ''; ?> value="DC">District Of Columbia</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='FL' ) ? 'selected="selected"' : ''; ?> value="FL">Florida</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='GA' ) ? 'selected="selected"' : ''; ?> value="GA">Georgia</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='HI' ) ? 'selected="selected"' : ''; ?> value="HI">Hawaii</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='ID' ) ? 'selected="selected"' : ''; ?> value="ID">Idaho</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='IL' ) ? 'selected="selected"' : ''; ?> value="IL">Illinois</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='IN' ) ? 'selected="selected"' : ''; ?> value="IN">Indiana</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='IA' ) ? 'selected="selected"' : ''; ?> value="IA">Iowa</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='KS' ) ? 'selected="selected"' : ''; ?> value="KS">Kansas</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='KY' ) ? 'selected="selected"' : ''; ?> value="KY">Kentucky</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='LA' ) ? 'selected="selected"' : ''; ?> value="LA">Louisiana</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='ME' ) ? 'selected="selected"' : ''; ?> value="ME">Maine</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='MD' ) ? 'selected="selected"' : ''; ?> value="MD">Maryland</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='MA' ) ? 'selected="selected"' : ''; ?> value="MA">Massachusetts</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='MI' ) ? 'selected="selected"' : ''; ?> value="MI">Michigan</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='MN' ) ? 'selected="selected"' : ''; ?> value="MN">Minnesota</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='MS' ) ? 'selected="selected"' : ''; ?> value="MS">Mississippi</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='MO' ) ? 'selected="selected"' : ''; ?> value="MO">Missouri</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='MT' ) ? 'selected="selected"' : ''; ?> value="MT">Montana</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='NE' ) ? 'selected="selected"' : ''; ?> value="NE">Nebraska</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='NV' ) ? 'selected="selected"' : ''; ?> value="NV">Nevada</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='NN' ) ? 'selected="selected"' : ''; ?> value="NH">New Hampshire</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='NJ' ) ? 'selected="selected"' : ''; ?> value="NJ">New Jersey</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='NM' ) ? 'selected="selected"' : ''; ?> value="NM">New Mexico</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='NY' ) ? 'selected="selected"' : ''; ?> value="NY">New York</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='NC' ) ? 'selected="selected"' : ''; ?> value="NC">North Carolina</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='ND' ) ? 'selected="selected"' : ''; ?> value="ND">North Dakota</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='OH' ) ? 'selected="selected"' : ''; ?> value="OH">Ohio</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='OK' ) ? 'selected="selected"' : ''; ?> value="OK">Oklahoma</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='OR' ) ? 'selected="selected"' : ''; ?> value="OR">Oregon</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='PA' ) ? 'selected="selected"' : ''; ?> value="PA">Pennsylvania</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='RI' ) ? 'selected="selected"' : ''; ?> value="RI">Rhode Island</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='SC' ) ? 'selected="selected"' : ''; ?> value="SC">South Carolina</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='SD' ) ? 'selected="selected"' : ''; ?> value="SD">South Dakota</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='TN' ) ? 'selected="selected"' : ''; ?> value="TN">Tennessee</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='TX' ) ? 'selected="selected"' : ''; ?> value="TX">Texas</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='UT' ) ? 'selected="selected"' : ''; ?> value="UT">Utah</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='VT' ) ? 'selected="selected"' : ''; ?> value="VT">Vermont</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='VA' ) ? 'selected="selected"' : ''; ?> value="VA">Virginia</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='WA' ) ? 'selected="selected"' : ''; ?> value="WA">Washington</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='WV' ) ? 'selected="selected"' : ''; ?> value="WV">West Virginia</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='WI' ) ? 'selected="selected"' : ''; ?> value="WI">Wisconsin</option>
                <option <?php echo (isset($_POST[ 'selectDropdown']) && $_POST[ 'selectDropdown']=='WY' ) ? 'selected="selected"' : ''; ?> value="WY">Wyoming</option>
            </select>
            <input type="text" name="latitudeCurrent" id="latitudeCurrent" style="display:none">
            <input type="text" name="longitudeCurrent" id="longitudeCurrent" style="display:none">
            <input type="text" name="cityCurr" id="cityCurrent" style="display:none">
            <input type="text" name="rowTime" id="rT" style="display:none">
            <input type="text" name="latOfSum" id="lS" style="display:none">
            <input type="text" name="lonOfSum" id="lNS" style="display:none">
            <br>
            <br>
            <br> <span style="margin-left:200px;margin-bottom:25px;">
                <input type="submit" value="Search" >
                <input type="button" value="Clear" onclick="clearLocationForm()"></span> </form>
    </div>
    <div id="dummy"> </div>
    <div id="dummydispCard"> </div>
    <br>
    <div id="dummydispTable"></div>
    <div id="dummydispCardDummt"> </div>
    <br>
    <br>
    <div id='showGraphSummary'> </div>
    <div id="chart_div">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </div>
    <!--Javascript Function-->
    <script type="text/javascript">
        flag = false;
        check = [];

        function sendTime(time, lat, lon) {
            document.getElementById('rT').value = time;
            document.getElementById('lS').value = lat;
            document.getElementById('lNS').value = lon;
            document.getElementById('locationForm').submit();
        }
        document.getElementById('currentLoc').onchange = function () {
            document.getElementById('dropdown').value = 'default';
            document.getElementById('dropdown').disabled = this.checked;
            document.getElementById('cityValue').value = '';
            document.getElementById('cityValue').disabled = this.checked;
            document.getElementById('streetValue').value = '';
            document.getElementById('streetValue').disabled = this.checked;
        }
        document.getElementById('showGraphSummary').onclick = function () {
            if (flag) {
                document.getElementById('showGraphSummary').innerHTML = "<h1 style='font-size:30px;text-align:center;'> Day's Hourly Weather</h1><img src='https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-down-512.png' height='45px'>";
                document.getElementById('chart_div').hidden = true;
                flag = false;
            }
            else {
                document.getElementById('showGraphSummary').innerHTML = "<h1 style='font-size:30px;text-align:center;'> Day's Hourly Weather</h1><img src='https://cdn0.iconfinder.com/data/icons/navigation-set-arrows-part-one/32/ExpandLess-512.png' height='45px'>";
                document.getElementById('chart_div').hidden = false;
                google.charts.load('current', {
                    packages: ['corechart', 'line']
                });
                google.charts.setOnLoadCallback(drawBasic);
                flag = true;
            }
        }

        function drawBasic() {
            sendDataToGoogle = [];
            tempData = check.split(",");
            for (var i = 0; i < tempData.length; i++) {
                var temp = [];
                temp[0] = i;
                temp[1] = parseFloat(tempData[i]);
                sendDataToGoogle[i] = temp;
            }
            var data = new google.visualization.DataTable();
            console.log(sendDataToGoogle);
            data.addColumn('number', 'X');
            data.addColumn('number', 'T');
            for (var i = 0; i < sendDataToGoogle.length; i++) {
                data.addRow(sendDataToGoogle[i]);
            }
            var options = {
                hAxis: {
                    title: 'Time'
                }
                , vAxis: {
                    title: 'Temperature'
                    , textPosition: 'none'
                }
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        function validateLocation() {
            if (document.getElementById('currentLoc').checked == true) {
                currentLocation();
                return true;
            }
            if (document.getElementById('dispTable')) {
                document.getElementById("dummydispCard").hidden = true;
                document.getElementById("dummydispTable").hidden = true;
            }
            var x = document.forms["locationForm"]["street"].value;
            var y = document.forms["locationForm"]["city"].value;
            var z = document.getElementById("dropdown").value;
            if (y == "" || x == "" || z == "default") {
                var d = document.createElement("div");
                d.setAttribute("id", "displayError");
                if (!document.getElementById("displayError")) {
                    document.getElementById("dummy").appendChild(d);
                    document.getElementById("displayError").innerHTML = "Please check the input address";
                }
                return false;
            }
            return true;
        }

        function clearLocationForm() {
            document.getElementById('locationForm').reset();
            document.getElementById('dropdown').value = "default";
            document.getElementById('streetValue').value = "";
            document.getElementById('cityValue').value = "";
            document.getElementById("dummydispCard").innerHTML = '';
            document.getElementById("dummydispTable").innerHTML = '';
            document.getElementById("dummy").innerHTML = '';
            document.getElementById('dummydispCardDummt').innerHTML = '';
            document.getElementById('currentLoc').checked = false;
            document.getElementById('showGraphSummary').innerHTML = '';
            document.getElementById('chart_div').innerHTML = '';
            document.getElementById('dropdown').disabled = false;
            document.getElementById('cityValue').disabled = false;
            document.getElementById('streetValue').disabled = false;
        }

        function currentLocation() {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            }
            else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.open("GET", "http://ip-api.com/json", false);
            xmlhttp.send();
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var jsonObj = JSON.parse(xmlhttp.responseText);
                document.getElementById('latitudeCurrent').value = jsonObj.lat;
                document.getElementById('longitudeCurrent').value = jsonObj.lon;
                document.getElementById('cityCurrent').value = jsonObj.city;
                return true;
            }
            return false;
        }
    </script>
    <?php 
         
         $imageArray = [
            "clear-day" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-12-512.png",
            "clear-night" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-12-512.png",
            "rain" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-04-512.png",
            "snow" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-19-512.png",
            "sleet" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-07-512.png",
            "wind"=>"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.png",
            "fog" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png",
            "cloudy" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-01-512.png",
            "partly-cloudy-day" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-02-512.png",
            "partly-cloudy-night" => "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-02-512.png"
            
        ];
    
        if (  $_POST["street"] != '' && $_POST["rowTime"]== ''){
            $getAddr = $_POST["street"].$_POST["city"].$_POST["dropdown"];
            $getAddr = urlencode($getAddr);
            // google map geocode api url
            $urlToGetLatLon = "https://maps.googleapis.com/maps/api/geocode/xml?address={$getAddr}&key=AIzaSyArrPEFuOp0DBKkj3UEtZkOHDlJORtQZdA";
            // get the json response 
            $getLocationFromXml = @file_get_contents($urlToGetLatLon);
            $getLoc = simplexml_load_string($getLocationFromXml);
        
            $status = $getLoc->status;
            if ($status!='OK'){
                echo "<script type='text/javascript'>  var d = document.createElement('div');
                d.setAttribute('id', 'displayError'); document.getElementById('dummy').appendChild(d);
                    document.getElementById('displayError').innerHTML = 'Please check the input address';</script>";
                return;
            }
            $latOfLoc = $getLoc->result->geometry->location->lat;
            $lonOfLoc = $getLoc->result->geometry->location->lng;
        }
        else if(isset($_POST['locationOn'])){
            $latOfLoc=$_POST["latitudeCurrent"];
            $lonOfLoc=$_POST["longitudeCurrent"];
            $_POST["city"] = $_POST["cityCurr"];
            echo "<script type='text/javascript'>  document.getElementById('dropdown').disabled = true;
            document.getElementById('cityValue').disabled = true;
            document.getElementById('streetValue').disabled = true; </script>";
        }
        if ($latOfLoc !='' || $lonOfLoc != '' && $_POST["rowTime"] == ''){
            $loc = $latOfLoc.",".$lonOfLoc;
            $urlToGetTheSummary = "https://api.forecast.io/forecast/1a6e3a63e040d6652a1ddbb2b9d8ae89/{$loc}?exclude=minutely,hourly,alerts,flags";
            $table = @file_get_contents($urlToGetTheSummary);
            
            // Display the data inside the table
            $tableJson = json_decode($table, true);
            $htmlBlock = "<div id='dispTable'><h2 id='userLoc'> ";
            $htmlBlock = $htmlBlock.$_POST["city"]."</h2><p id='timeZone'>".$tableJson['timezone']."</p><p><span style='line-height: 0.9;font-size: 80px;margin-top: 50px;margin-left: 15px;'>".round($tableJson['currently']['temperature']).'</span><img id='. "'tempdegreeF'" .' height='."'15px'". ' width='."'15px'". ' src='. "'https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png'></sup>";
            $htmlBlock = $htmlBlock."<span style='font-size:42px'>F</span>";
            $htmlBlock = $htmlBlock."<h2 id='summary'>".$tableJson['currently']['summary']."</h2>";
            $htmlBlock = $htmlBlock. "<div id='icons'><div class='eachIcon'><img  title='Humidity' id ='first' height='26px' width='26px' src='https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-16-512.png'><br><span style='margin-left:10px;'>".$tableJson['currently']['humidity']."</span></span></div><div class='eachIcon'><img title='Pressure' height='26px' width='26px' src='https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-25-512.png'><br>".$tableJson['currently']['pressure']."</div><div class='eachIcon'><img title='WindSpeed' height='26px' width='26px' src='https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.png'><br>".$tableJson['currently']['windSpeed']."</div><div class='eachIcon'><img title='Visibility' height='26px' width='26px' src='https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-30-512.png'><br>".$tableJson['currently']['visibility']."</div><div class='eachIcon'><img  title='CloudCover' height='26px' width='26px'  src='https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png'><br>".$tableJson['currently']['cloudCover']."</div><div class='eachIcon'><img title='Ozone' height='26px' width='26px'  src='https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-24-512.png'><br>".$tableJson['currently']['ozone']."</div></div>";
            $htmlBlock ='"'.$htmlBlock.'"';
            
            $dataDaily = $tableJson['daily']['data'];
            
            $htmlTable = "<table cellspacing='0'  CELLPADDING='9' id='dailySummary'><tr><th> Date</th><th> Status </th><th> Summary </th><th> TemperatureHigh </th><th> TemperatureLow</th><th> WindSpeed </th></tr>";
            for ($i=0; $i < count($dataDaily); $i++){

                $htmlTable = $htmlTable.'<tr><td>'.date('Y-m-d',substr($dataDaily[$i]['time'],0,10)).'</td><td>';
                $htmlTable = $htmlTable.'<img height='."'35px'". ' width='."'35px'".' src='."'" . $imageArray[$dataDaily[$i]['icon']]."'></td><td>";
                $htmlTable = $htmlTable.'<a class='."'summaryLink'" . ' href='."'#'".' onclick='."'sendTime(".$dataDaily[$i]['time'].','.$latOfLoc.','.$lonOfLoc.");'>".$dataDaily[$i]['summary'].'</a></td><td>';
                $htmlTable = $htmlTable.$dataDaily[$i]['temperatureHigh'].'</td><td>';
                $htmlTable = $htmlTable.$dataDaily[$i]['temperatureLow'].'</td><td>';
                $htmlTable = $htmlTable.$dataDaily[$i]['windSpeed'].'</td></tr>';
                
            }
            $htmlTable = $htmlTable."</table>";
            $htmlTable ='"'.$htmlTable.'"';
            
            
            echo '<script type="text/javascript">document.getElementById("dummydispCard").innerHTML='.$htmlBlock.';</script>'; 
            echo '<script type="text/javascript">document.getElementById("dummydispTable").innerHTML='.$htmlTable.';</script>';
            
       
        
    }
    
      if ($_POST["rowTime"]!= ''){
    
           $imageArraySummary = [
            "clear-day" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/sun-512.png",
            "clear-night" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/sun-512.png",
            "rain" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/rain-512.png",
            "snow" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/snow-512.png",
            "sleet" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/lightning-512.png",
            "wind"=>"https://cdn4.iconfinder.com/data/icons/the-weather-is-nice-today/64/weather_10-512.png",
            "fog" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/cloudy-512.png",
            "cloudy" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/cloud-512.png",
            "partly-cloudy-day" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/sunny-512.png",
            "partly-cloudy-night" => "https://cdn3.iconfinder.com/data/icons/weather-344/142/sunny-512.png"
            
        ];
          
          $temperatureData = array();
   
            $timeP = $_POST['rowTime'];
            $lat = $_POST['latOfSum'];
            $lon = $_POST['lonOfSum'];
            $loc = $lat.','.$lon.','.$timeP;
             
            $urlDesc = "https://api.forecast.io/forecast/1a6e3a63e040d6652a1ddbb2b9d8ae89/{$loc}?exclude=minutely";
            $completeData = @file_get_contents($urlDesc);
            // Display the data inside the table
            $cardData = json_decode($completeData, true);
            $dataS = $cardData['hourly']['data'];
            for ($i=0; $i < count($dataS); $i++){
               $temperatureData[$i] = $dataS[$i]['temperature'];
           }

                
            $htmlTable = "<h1 style='font-size:30px;text-align:center;'> Daily Weather Detail</h1><div id='cardSummary'><div ><div class='summ' style='float:left; width:50%;margin-top:40px;'>".$cardData['currently']['summary']."<p id='temperature' > <span id='result' style='font-size:".'90px'.";margin-left:8px;'>";
            $htmlTable =  $htmlTable.round($cardData['currently']['temperature']). '<sup><img id='. "'tempdegree'" .' height='."'15px'". ' width='."'15px'". ' src='. "'https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png'></sup><span style='font-size:65px'>F</span>". '</span></p></div>'."<div>";
             $htmlTable = $htmlTable.'<img id='."'imgSumm'" .'height='."'45px'". ' width='."'45px'"."style='margin-right:25px;'". 'src='."'" . $imageArraySummary[$cardData['currently']['icon']]."'></div></div><div id='data'>";
             //echo $cardData['currently']['icon'];
         
            if (($cardData['currently']['precipIntensity']) <= 0.001){
                 $htmlTable = $htmlTable."<p class='labels' style='margin-top:15px;margin-bottom:18px;'> Precipitaion: <span id='result' style='margin-left: 0px;'> ".'None'."</span></p>";
            }
            else if (($cardData['currently']['precipIntensity']) <=0.015){
                 $htmlTable = $htmlTable."<p class='labels' style='margin-top:15px;margin-bottom:18px;'> Precipitaion:<span id='result' style='margin-left: 0px;'>  ".'Very Light'."</span></p>";
            }
           else if (($cardData['currently']['precipIntensity']) <=0.05){
                 $htmlTable = $htmlTable."<p class='labels' style='margin-top:15px;margin-bottom:18px;'> Precipitaion:<span id='result' style='margin-left: 0px;'> ".'Light'."</span></p>";
            }
          else if(($cardData['currently']['precipIntensity']) <=0.1){
                 $htmlTable = $htmlTable."<p class='labels' style='margin-top:15px;margin-bottom:18px;'> Precipitaion:<span id='result' style='margin-left: 0px;'>  ".'Moderate'."</span></p>";
            }
          else if(($cardData['currently']['precipIntensity']) > 0.1){
                 $htmlTable = $htmlTable."<p class='labels' style='margin-top:15px;margin-bottom:18px;'> Precipitaion:<span id='result' style='margin-left: 0px;'>   ".'high'."</span></p>";
            }
             date_default_timezone_set($cardData['timezone']);
             $cOR = $cardData['currently']['precipProbability'] * 100;
             $humidity = $cardData['currently']['humidity']*100;
             $htmlTable = $htmlTable."<p class='labels' style='margin-left:125px;'>Chance of Rain: <span id='result'>".round($cOR)."</span>%</p>";
             $htmlTable = $htmlTable."<p class='labels' > Wind Speed:<span id='result'> ".$cardData['currently']['windSpeed']." </span> mph</p>";
             $htmlTable = $htmlTable."<p class='labels' style='margin-left:177px;' > Humidity: <span id='result'>".$humidity."</span>%</p>";
             $htmlTable = $htmlTable."<p class='labels' style='margin-left:182px;'  > Visibility: <span id='result'>".round($cardData['currently']['visibility'],3)." </span> mi</p>";
            $htmlTable = $htmlTable."<p class='labels' style='margin-left:128px;'  > Sunrise/Sunset: <span id= 'result'>". date('g a',$cardData['daily']['data'][0]['sunriseTime']).'/'.date('g a',$cardData['daily']['data'][0]['sunsetTime'])."</span></p></div></div>";
             $_POST['tempArr'] = $temperatureData;
             
            echo '<script type="text/javascript"> check = "' . implode(',',$temperatureData) .'";</script>';
            echo '<script type="text/javascript">document.getElementById("dummydispCardDummt").innerHTML="'.$htmlTable.'";</script>';
            echo '<script type="text/javascript">document.getElementById("showGraphSummary").innerHTML="'."<h1 style='font-size:30px;text-align:center;'> Day's Hourly Weather</h1><img src='https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-down-512.png' height='45px'>".'";</script>';
           
           
            return true;
        }
    
    ?>
</body>

</html>