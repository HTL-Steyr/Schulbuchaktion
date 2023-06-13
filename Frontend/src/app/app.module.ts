import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {DxButtonModule, DxDataGridModule} from 'devextreme-angular';


import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { OrderlistComponent } from './orderlist/orderlist.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { LoginErrorAlertComponent } from './login-error-alert/login-error-alert.component';
import { UploadButtonComponent } from './upload-button/upload-button.component';
import { XlsImportComponent } from './xls-import/xls-import.component';
import { ClassesOverviewComponent } from './classes-overview/classes-overview.component';
import { MoneyViewComponent } from './money-view/money-view.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { LoginComponent } from './login/login.component';
import { HttpClientModule } from '@angular/common/http';
import { NavBarComponent } from './nav-bar/nav-bar.component';
import { ShowMenuItemPipe } from './nav-bar/nav-bar.component';

@NgModule({
  declarations: [
    MoneyViewComponent,
    AppComponent,
    OrderlistComponent,
    ClassesOverviewComponent,
    NotFoundComponent,
    UploadButtonComponent,
    XlsImportComponent,
    LoginErrorAlertComponent,
    LoginComponent,
    NavBarComponent,
    ShowMenuItemPipe

  ],
  imports: [
    BrowserModule,
    DxButtonModule,
    DxDataGridModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})


export class AppModule { }
