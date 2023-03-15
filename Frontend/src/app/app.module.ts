import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {DxButtonModule, DxDataGridModule} from 'devextreme-angular';


import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { OrderlistComponent } from './orderlist/orderlist.component';

@NgModule({
  declarations: [
    AppComponent,
    OrderlistComponent
  ],
  imports: [
    BrowserModule,
    DxButtonModule,
    DxDataGridModule,
    AppRoutingModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
