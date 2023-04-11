import {Component, NgModule, OnInit} from '@angular/core';
import { DxButtonModule } from 'devextreme-angular';

@Component({
  selector: 'app-money-view',
  templateUrl: './money-view.component.html',
  styleUrls: ['./money-view.component.css']
})


export class MoneyViewComponent implements OnInit {




  constructor() {
  }

  ngOnInit(): void {
  }

  helloWorld() {

    console.log("Hello")
  }
}
