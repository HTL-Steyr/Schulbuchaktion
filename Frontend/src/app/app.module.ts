import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { XlsImportComponent } from './xls-import/xls-import.component';
import { UploadButtonComponent } from './upload-button/upload-button.component';

@NgModule({
  declarations: [
    AppComponent,
    XlsImportComponent,
    UploadButtonComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
