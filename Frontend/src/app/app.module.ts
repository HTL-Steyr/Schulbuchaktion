import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {DxButtonModule, DxDataGridModule} from 'devextreme-angular';


import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { OrderlistComponent } from './orderlist/orderlist.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { ClassesOverviewComponent } from './classes-overview/classes-overview.component';

@NgModule({
  declarations: [
    AppComponent,
    OrderlistComponent,
    NotFoundComponent,
    ClassesOverviewComponent
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
