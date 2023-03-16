import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { MoneyViewComponent } from './money-view/money-view.component';
import {DevExtremeModule, DxButtonModule} from 'devextreme-angular';
import { AppRoutingModule } from './app-routing.module';

@NgModule({
  declarations: [
    AppComponent,
    MoneyViewComponent
  ],
  imports: [
    BrowserModule,
    DevExtremeModule,
    AppRoutingModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})


export class AppModule { }
