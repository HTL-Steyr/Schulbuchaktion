import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {DxButtonModule, DxDataGridModule} from 'devextreme-angular';


import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    DxButtonModule,
    DxDataGridModule
    AppRoutingModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
