import { Component, OnInit } from '@angular/core';
import {CommunicationService} from '../communicationService.service';
import * as CanvasJS from '../../assets/canvasjs.min.js';
import { DatePipe } from '@angular/common';


import {max, min} from 'rxjs/operators';

@Component({
  selector: 'app-results-tab',
  templateUrl: './results-tab.component.html',
  styleUrls: ['./results-tab.component.css'],

})



export class ResultsTabComponent implements OnInit {
  weatherDataReceived: any;
  cityNameReceived: any;
  sealUrlDataReceived: any;
  public dailyData: any;
  public tempData;
  public chartReady: boolean;
  public weeklyTemp;
  public summary;
  public iconString;
  public stateValue;
  // public twitterData;

  public barChartOptions;
  public barChartLabels;
  public barChartType;
  public barChartLegend;
  public barChartData;
  public minValue;
  public maxValue;

  public precipitation;
  public chanceOfRain ;
  public windSpeed ;
  public humidity ;
  public visibility
  public requiredData;
  public dateString;

  constructor(private service: CommunicationService) {
  }

  getTemp() {
    return Math.round(parseFloat(this.weatherDataReceived.currently.temperature));
  }

   selectedStar() {
    if (document.getElementById('favoriteStar').classList.contains('notOn')) {
      document.getElementById('favoriteStar').classList.remove('notOn');
      document.getElementById('favoriteStar').innerText = 'star';
      document.getElementById('favoriteStar').classList.add('On');
      const objToStore = {
        cityName:  this.cityNameReceived,
        stateName: this.stateValue,
        sealImgPath: this.sealUrlDataReceived.items[0].link
      };

      localStorage.setItem(this.cityNameReceived, JSON.stringify(objToStore));
      console.log('Object stored in localstorage');
    } else {
      document.getElementById('favoriteStar').classList.remove('On');
      document.getElementById('favoriteStar').innerText = 'star_border';
      document.getElementById('favoriteStar').classList.add('notOn');
    }
  }


  getDataTemp() {

    const dataArray = [];
    for (let i = 0; i < 24; i++) {
      dataArray[i] = Math.round(parseFloat(this.weatherDataReceived.hourly.data[i].temperature));
    }
    return dataArray;
  }

  prepareWeeklyData() {
    console.log('prepareWeeklyData() reached');
    const chart = new CanvasJS.Chart( 'weeklyTabData', {
      animationEnabled: true,
      title: {
        text: 'Weekly Weather',
        fontSize: 32
      },
      axisX: {
        title: 'Days'
      },
      axisY: {
        includeZero: false,
        interval: 10,
        title: 'Temperature in Fahrenheit',
        gridThickness: 0
      },
      data: [{
        type: 'rangeBar',
        showInLegend: true,
        indexLabel: '{y[#index]}',
        legendText: 'Day wise temperature range',
        toolTipContent: '<b>{label}</b>: {y[0]} to {y[1]}',
        dataPoints: [
          { x: 10, y: this.getBarYData(6), label: this.getBarLabel(6), click: (event) => {this.displayPopup(event); }},
          { x: 20, y: this.getBarYData(5), label: this.getBarLabel(5), click: (event) => {this.displayPopup(event); }},
          { x: 30, y: this.getBarYData(4), label: this.getBarLabel(4), click: (event) => {this.displayPopup(event); } },
          { x: 40, y: this.getBarYData(3), label: this.getBarLabel(3), click: (event) => {this.displayPopup(event); } },
          { x: 50, y: this.getBarYData(2), label: this.getBarLabel(2), click: (event) => {this.displayPopup(event); } },
          { x: 60, y: this.getBarYData(1), label: this.getBarLabel(1), click: (event) => {this.displayPopup(event); } },
          { x: 70, y: this.getBarYData(0), label: this.getBarLabel(0), click: (event) => {this.displayPopup(event); } },
        ],
        color: '#93c9f1'
      }],

      dataPointWidth: 20,
      legend: {
        verticalAlign: 'top'
      }
    });

    setTimeout(() => {
      chart.render();
    }, 500);
  }


  changeDataForChart(event) {
      const dataArray = [];
      let label;
      let upperLabel;
      if (event.target.value === 'PressureGraph') {
        for (let i = 0; i < 24; i++) {
          dataArray[i] = Math.round(parseFloat(this.weatherDataReceived.hourly.data[i].pressure));
          label = 'Millibars';
          upperLabel = 'Pressure';
        }
      } else if (event.target.value === 'HumidityGraph') {
        for (let i = 0; i < 24; i++) {
          dataArray[i] = Math.round(parseFloat(this.weatherDataReceived.hourly.data[i].humidity));
          label = '% Humidity';
          upperLabel = 'Humidity';
        }
      } else if (event.target.value === 'OzoneGraph') {
        for (let i = 0; i < 24; i++) {
          dataArray[i] = Math.round(parseFloat(this.weatherDataReceived.hourly.data[i].ozone));
          label = 'Dobson Units';
          upperLabel = 'Ozone';
        }
      } else if (event.target.value === 'VisibilityGraph') {
        for (let i = 0; i < 24; i++) {
          dataArray[i] = Math.round(parseFloat(this.weatherDataReceived.hourly.data[i].visibility));
          label = 'Miles (Maximum 10)';
          upperLabel = 'Visibility';
        }
      } else if (event.target.value === 'windSpeedGraph') {
        for (let i = 0; i < 24; i++) {
          dataArray[i] = Math.round(parseFloat(this.weatherDataReceived.hourly.data[i].windSpeed));
          label = 'Miles per hour';
          upperLabel = 'Wind Speed';
        }
      } else {
        for (let i = 0; i < 24; i++) {
          dataArray[i] = Math.round(parseFloat(this.weatherDataReceived.hourly.data[i].temperature));
          label = 'Fahrenheit';
          upperLabel = 'Temperature';
        }
      }
      this.prepareRemainingCharts( dataArray , label , upperLabel );
  }

  prepareRemainingCharts(dataArray, label , upperLabel) {
    // Initially only temperature data
    this.minValue  = (Math.min(...dataArray) - 4 < 0) ? 0 : Math.min(...dataArray)  - 4 ;
    this.maxValue = Math.max(...dataArray) + 4 ;
    this.barChartOptions = {
      scaleShowVerticalLines: false,
      responsive: true,
      legend: {
        onClick: (event) => event.stopPropagation()
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false,
            suggestedMax: this.maxValue,
            suggestedMin: this.minValue
          },
          scaleLabel: {
            display: true,
            labelString: label
          }
        }]
      }
    };

    this.barChartLabels = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
      12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23];

    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.barChartData = [{data: dataArray,
      label: upperLabel,
      backgroundColor: '#5cc3f3',
      hoverBackgroundColor : '#5cc3f3', hoverBorderColor : '#5cc3f3' , borderColor : '' }];
  }

  prepareDataForChart() {
    // Initially only temperature data
    this.tempData = this.getDataTemp();
    this.minValue  = Math.min(...this.tempData) - 4;
    this.maxValue = Math.max(...this.tempData) + 4;
    this.barChartOptions = {
      scaleShowVerticalLines: false,
      responsive: true,
      legend: {
        onClick: (event) => event.stopPropagation()
      },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false,
            suggestedMax: this.maxValue,
            suggestedMin: this.minValue
          },
          scaleLabel: {
            display: true,
            labelString: 'Fahrenheit'
          }
        }]
       }
    };

    this.barChartLabels = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
      12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23];

    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.barChartData = [{data: this.tempData,
                          label: 'Temperature',
                          backgroundColor: '#5cc3f3',
                          hoverBackgroundColor : '#5cc3f3', hoverBorderColor : '#5cc3f3' , borderColor : '' }];
    this.chartReady = true;
  }


  ngOnInit() {


    this.service.cityFormDataForDisplay.subscribe(
      cityNameReceived => this.cityNameReceived = cityNameReceived
    );

    this.service.castSealData.subscribe(
      sealUrlDataReceived => {
        this.sealUrlDataReceived = sealUrlDataReceived;
      });

    this.service.castcurrentLocData.subscribe(
      weatherDataReceived => {
        this.weatherDataReceived = weatherDataReceived;
      });

    this.service.getStateName.subscribe(
      stateValue => {
        this.stateValue = stateValue;
      });
  }

  public getBarYData(day) {
    const ydata = [];
    ydata[0] = Math.round(parseFloat(this.weatherDataReceived.daily.data[day].temperatureLow));
    ydata[1] = Math.round(parseFloat(this.weatherDataReceived.daily.data[day].temperatureHigh));

    return ydata;
  }

  public getBarLabel(day) {
    const dateObject = new Date(this.weatherDataReceived.daily.data[day].time * 1000);
    const label = dateObject.getUTCDate() + '/' + dateObject.getUTCMonth() + '/' + dateObject.getUTCFullYear();

    return label;
  }

  twitterData() {
    let temp = 'https://twitter.com/intent/tweet?text=' + 'The current temperature at ' + this.cityNameReceived ;
    temp = temp + ' is ' + this.weatherDataReceived.currently.temperature + '° F. The weather conditions are ' ;
    temp = temp + this.weatherDataReceived.currently.summary + '&hashtags=CSCI571WeatherSearch';
    this.requiredData = temp;
  }

  public getDateString(dateObj) {
    const datePipe = new DatePipe('en-US');
    return datePipe.transform(dateObj * 1000,  'dd/MM/yyyy');
  }

  private getIcon(iconValue){
    if (iconValue === 'clear-day' || iconValue === 'clear-night') {
      return 'https://cdn3.iconfinder.com/data/icons/weather-344/142/sun-512.png';
    } else if (iconValue === 'rain') {
        return 'https://cdn3.iconfinder.com/data/icons/weather-344/142/rain-512.png';
    } else if (iconValue === 'snow') {
        return 'https://cdn3.iconfinder.com/data/icons/weather-344/142/snow-512.png';
    } else if (iconValue === 'sleet') {
      return 'https://cdn3.iconfinder.com/data/icons/weather-344/142/lightning-512.png';
    } else if (iconValue === 'wind') {
      return 'https://cdn4.iconfinder.com/data/icons/the-weather-is-nice-today/64/weather_10-512.png';
    } else if (iconValue === 'fog') {
     return 'https://cdn3.iconfinder.com/data/icons/weather-344/142/cloudy-512.png';
    } else if (iconValue === 'cloudy') {
      return 'https://cdn3.iconfinder.com/data/icons/weather-344/142/cloud-512.png';
    } else if (iconValue === 'partly-cloudy-day' || iconValue === 'partly-cloudy-night') {
      return 'https://cdn3.iconfinder.com/data/icons/weather-344/142/sunny-512.png';
    }
  }

  private displayPopup(event: any) {
    const longitude = this.weatherDataReceived.longitude;
    const latitude = this.weatherDataReceived.latitude;
    const time = this.weatherDataReceived.daily.data[6 - event.dataPointIndex].time;
    // Call service function to get weather data with time
    this.service.getDailyData(longitude, latitude, time).subscribe(
      data => {
        this.dailyData = data;
        this.dateString = this.getDateString(this.dailyData.daily.data[0].time);
        this.weeklyTemp = Math.round(parseFloat(this.dailyData.currently.temperature));
        this.summary   = this.dailyData.currently.summary;
        this.iconString = this.getIcon(this.dailyData.currently.icon);
        this.precipitation = parseFloat(this.dailyData.currently.precipIntensity).toFixed(2);
        this.chanceOfRain = Math.round(this.dailyData.currently.precipProbability * 100);
        this.windSpeed = parseFloat(this.dailyData.currently.windSpeed).toFixed(2);
        this.humidity = Math.round(this.dailyData.currently.humidity * 100 );
        this.visibility = this.dailyData.currently.visibility;
      });
    document.getElementById('popUpForWeeklyData').click();


  }
}


