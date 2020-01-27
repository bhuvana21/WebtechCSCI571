import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

import { ResultsTabComponent } from './results-tab/results-tab.component';
import { FavoritesTabComponent } from './favorites-tab/favorites-tab.component';
import { AppComponent } from './app.component';


const appRoutes: Routes = [
  {path: '', redirectTo: '', pathMatch: 'full'},
  {path: 'results', component: ResultsTabComponent},
  {path: 'favorites', component: FavoritesTabComponent},
];


@NgModule({
  imports : [RouterModule.forRoot(appRoutes)],
  exports : [RouterModule]
})

export class AppRoutingModule{

}
