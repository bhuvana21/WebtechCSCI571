import { Component, OnInit } from '@angular/core';
import { CommunicationService } from '../communicationService.service';
import { FormControl} from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import {checkIfGenericTypesAreUnbound} from '@angular/compiler-cli/src/ngtsc/typecheck/src/ts_util';


@Component({
  selector: 'app-weather-search-form',
  templateUrl: './weather-search-form.component.html',
  styleUrls: ['./weather-search-form.component.css'],
})
export class WeatherSearchFormComponent implements OnInit {

  currentLocation: boolean;
  weatherData = [];
  weatherDataReceived;
  submitButton: boolean;
  locationData;
  sealUrlReceived;
  progressBar = false;


  control = new FormControl();
  citynames = [];
  cityNameOptions = [] as any;


  private stateAbbrToStateName = {AL: 'Alabama',
    AK: 'Alaska',
    AS: 'American Samoa',
    AZ: 'Arizona',
    AR: 'Arkansas',
    CA: 'California',
    CO: 'Colorado',
    CT: 'Connecticut',
    DE: 'Delaware',
    DC: 'District Of Columbia',
    FM: 'Federated States Of Micronesia',
    FL: 'Florida',
    GA: 'Georgia',
    GU: 'Guam',
    HI: 'Hawaii',
    ID: 'Idaho',
    IL: 'Illinois',
    IN: 'Indiana',
    IA: 'Iowa',
    KS: 'Kansas',
    KY: 'Kentucky',
    LA: 'Louisiana',
    ME: 'Maine',
    MH: 'Marshall Islands',
    MD: 'Maryland',
    MA: 'Massachusetts',
    MI: 'Michigan',
    MN: 'Minnesota',
    MS: 'Mississippi',
    MO: 'Missouri',
    MT: 'Montana',
    NE: 'Nebraska',
    NV: 'Nevada',
    NH: 'New Hampshire',
    NJ: 'New Jersey',
    NM: 'New Mexico',
    NY: 'New York',
    NC: 'North Carolina',
    ND: 'North Dakota',
    MP: 'Northern Mariana Islands',
    OH: 'Ohio',
    OK: 'Oklahoma',
    OR: 'Oregon',
    PW: 'Palau',
    PA: 'Pennsylvania',
    PR: 'Puerto Rico',
    RI: 'Rhode Island',
    SC: 'South Carolina',
    SD: 'South Dakota',
    TN: 'Tennessee',
    TX: 'Texas',
    UT: 'Utah',
    VT: 'Vermont',
    VI: 'Virgin Islands',
    VA: 'Virginia',
    WA: 'Washington',
    WV: 'West Virginia',
    WI: 'Wisconsin',
    WY: 'Wyoming'
  };
  public lat;
  public lon;
  public city;
  public streetName;
  public state;

  checkForInput() {
    if ( this.streetName.isEmpty() && this.city.isEmpty() && this.state.length !== 2 ) {
          return true;
        } else if (this.currentLocation) {
        return false;
      } else {
      return false;
    }
  }

  currentLSet(changeEvent) {
    if (changeEvent.target.checked) {
      this.currentLocation = true;
      this.submitButton = false;
      this.control.disable();

    } else {
      this.currentLocation = false;
      this.control.enable();
      this.submitButton = true;
    }
  }

  resetMyForm() {
    this.control.reset();
    this.currentLocation = false;
    this.control.enable();
    this.progressBar = false;
  }

  constructor(private service: CommunicationService, private httpService: HttpClient ) {
  }


  getInputData() {
    this.progressBar = true;
    if (this.currentLocation) {
      console.log(this.currentLocation);
      this.httpService.get('http://ip-api.com/json').subscribe( data => {
        this.locationData = data;
        console.log(this.locationData);
        this.lat = this.locationData.lat;
        this.lon = this.locationData.lon;
        this.city = this.locationData.city;
        this.state = this.locationData.region;
        this.service.getSealUrl(this.stateAbbrToStateName[this.state]).subscribe(
          sealUrlReceived => {
            this.sealUrlReceived = sealUrlReceived;
            this.service.setSealData(this.sealUrlReceived);
          }
        )
        this.service.getLocationData(this.lat, this.lon).subscribe(
          weatherData => {
            this.locationData = weatherData;
            this.service.setLocData(this.locationData);
            console.log('LocationData from ip-api : ' + this.locationData);
            this.progressBar = false;
          });
        this.service.setCityStateValue(this.city, this.state);
        console.log(this.city);
      });

    } else {
      const streetName = (document.getElementById('streetName')as HTMLInputElement).value;
      const city = (document.getElementById('cityName')as HTMLInputElement).value;
      const state = (document.getElementById('stateName')as HTMLInputElement).value;
      console.log(this.stateAbbrToStateName[state] + 'anurag request data');
      this.service.getSealUrl(this.stateAbbrToStateName[state]).subscribe(
        sealUrlReceived => {
          this.sealUrlReceived = sealUrlReceived;
          this.service.setSealData(this.sealUrlReceived);

        }
      )

      this.city = city;
      this.state = state;
      this.streetName = streetName;
      this.service.getData( this.streetName , this.city, this.state ).subscribe(
        data => {
          this.locationData = data;
          this.service.setLocData(this.locationData);
          this.service.setCityStateValue(this.city, this.state);
          this.progressBar = false;
        });

    }

  }


  ngOnInit() {

    this.control.valueChanges.subscribe(
      term => {
        if (term !== '') {
          this.service.search(term).subscribe(
            data => {

              this.cityNameOptions = data as any[];
              for ( let i = 0 ; i < this.cityNameOptions.predictions.length; i++) {
                 this.citynames[i] = this.cityNameOptions.predictions[i].structured_formatting.main_text;
              }

            });
        }
      });

  }


}

