import {Injectable} from '@angular/core';

import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { debounceTime } from 'rxjs/internal/operators/debounceTime';
import {BehaviorSubject} from 'rxjs';


@Injectable()
export class CommunicationService {

  private sealData = new BehaviorSubject('');
  castSealData  = this.sealData.asObservable();

  private currentLocData = new BehaviorSubject('');
  castcurrentLocData  = this.currentLocData.asObservable();

  private cityFormData = new BehaviorSubject('');
  cityFormDataForDisplay = this.cityFormData.asObservable();

  private stateFormData = new BehaviorSubject('');
  getStateName = this.stateFormData.asObservable();

  // http://localhost:3000/
  public urlLocal = 'http://localhost:5000/';

  constructor(private httpService: HttpClient) { }



    setLocData(newLocationData) {
      this.currentLocData.next(newLocationData);
    }

    setCityStateValue(cityName, state) {
      this.cityFormData.next(cityName);
      this.stateFormData.next(state);
    }

    setSealData(sealUrl) {
    this.sealData.next(sealUrl);
  }

    search(term) {
     const url = this.urlLocal +  'getAutoComplete?inputCity=' + term;
     const listOfCities = this.httpService.get(url )
        .pipe(
            debounceTime(500),  // WAIT FOR 500 MILISECONDS ATER EACH KEY STROKE.
            map(
                (data: any) => {
                    return (
                        data.length !== 0 ? data as any[] : [{cityName: 'No Record Found'} as any]
                    );
                }
        ));

        return listOfCities;
    }

  getData(street, city , state) {
    const url = this.urlLocal +  'getResult?streetName=' + street + '&cityName=' + city + '&stateName=' + state;
    const resultData = this.httpService.get(url)
      .pipe(
          map(
          (data: any) => {
            return (

              data.length !== 0 ? data as any[] : [{result: 'No Record Found'} as any]
            );
          }
        ));
    return resultData;

  }

  getLocationData(lat, lon) {
    const url = this.urlLocal +  'getResultCurrLocation?lat=' + lat + '&lon=' + lon;
    const resultData = this.httpService.get(url)
      .pipe(
        map(
          (data: any) => {
            return (

              data.length !== 0 ? data as any[] : [{result: 'No Record Found'} as any]
            );
          }
        ));
    return resultData;

  }

  getSealUrl(state) {
    const url = this.urlLocal +  'getSealUrl?stateName=' + state;
    const resultData = this.httpService.get(url)
      .pipe(
        map(
          (data: any) => {
            return (

              data.length !== 0 ? data as any[] : [{result: 'No Record Found'} as any]
            );
          }
        ));
    return resultData;
  }

  getDailyData(longitude, latitude, time) {
    const url = this.urlLocal + 'getResultDaily?time=' + time + '&lat=' + latitude + '&lon=' + longitude;
    const resultData = this.httpService.get(url)
      .pipe(
        map(
          (data: any) => {
            return (
              data.length !== 0 ? data as any[] : [{result: 'No Record Found'} as any]
            );
          }
        ));
    return resultData;
  }
}
