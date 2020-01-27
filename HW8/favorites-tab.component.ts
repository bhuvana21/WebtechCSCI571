import { Component, OnInit } from '@angular/core';
import {CommunicationService} from '../communicationService.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-favorites-tab',
  templateUrl: './favorites-tab.component.html',
  styleUrls: ['./favorites-tab.component.css']
})
export class FavoritesTabComponent implements OnInit {
  public arrayOfFav = [];
  public keys = [];

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

  constructor(private service: CommunicationService, private router: Router) { }

  ngOnInit() {
    length = localStorage.length;
    this.readFromStorage();
  }

  readFromStorage() {

    const keysOfSaved = Object.keys(localStorage);
    const lengthOfObjects = localStorage.length;

    for (let i = 0; i < lengthOfObjects; i++) {
      this.arrayOfFav[i] = JSON.parse(localStorage.getItem(keysOfSaved[i]));
    }
  }

  removeSavedCity(cityName) {
    localStorage.removeItem(cityName);
    this.keys = [];
    this.arrayOfFav = [];

    this.readFromStorage();
  }

  showResults(cityName, stateName) {
    // Set city and state value to new cityName and stateName
    console.log('State name sending from fav : ' + stateName);
    this.service.setCityStateValue(cityName, stateName);
    this.service.getData('', cityName, stateName)
      .subscribe(data => {
        this.service.setLocData(data);
        this.service.getSealUrl(this.stateAbbrToStateName[stateName])
          .subscribe(sealData => {
            this.service.setSealData(sealData);
            // console.log('Changing sealData from fav component to ' + sealData.items[0].link);
            this.router.navigate(['results']);
          });
      });
  }
}
