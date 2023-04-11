import { Component } from '@angular/core';

@Component({
  selector: 'app-upload-button',
  templateUrl: './upload-button.component.html',
  styleUrls: ['./upload-button.component.css']
})
export class UploadButtonComponent {
  click(){
    let input = document.createElement('input');
    input.type = 'file';
    input.accept = '.xlsx, .xls, .csv'
    input.onchange = _ => {
      // @ts-ignore
      let files =   Array.from(input.files);
      console.log(files);
    };
    input.click();
  }
}
