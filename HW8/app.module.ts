import { BrowserModule } from '@angular/platform-browser';
import { AppComponent } from './app.component';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { WeatherSearchFormComponent } from './weather-search-form/weather-search-form.component';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { MatInputModule } from '@angular/material/input';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { ResultsTabComponent } from './results-tab/results-tab.component';
import { FavoritesTabComponent } from './favorites-tab/favorites-tab.component';
import {AppRoutingModule} from './appRouting.module';
import {CommunicationService} from './communicationService.service';
import {MatTooltipModule} from '@angular/material/tooltip';
import { ChartsModule } from 'ng2-charts';




@NgModule({
  declarations: [
    AppComponent,
    WeatherSearchFormComponent,
    ResultsTabComponent,
    FavoritesTabComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    MatInputModule,
    MatAutocompleteModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    MatTooltipModule,
    ChartsModule
  ],
  providers: [CommunicationService],
  bootstrap: [AppComponent]
})
export class AppModule { }
