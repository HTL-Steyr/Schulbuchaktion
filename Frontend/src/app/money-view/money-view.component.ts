import {Component, NgModule, OnInit} from '@angular/core';
import {Observable} from "rxjs";
import {MoneylistEntry} from "../model/moneylistEntry";
import DataSource from "devextreme/data/data_source";
import DevExpress from "devextreme";
import CustomStore = DevExpress.data.CustomStore;

@Component({
  selector: 'app-money-view',
  templateUrl: './money-view.component.html',
  styleUrls: ['./money-view.component.css']
})


export class MoneyViewComponent {
  private moneyListService: any;
  constructor() {
  }

    dataSource: DataSource<MoneylistEntry> =  new DataSource({
      key: "id",
      load: () => {
        return this.moneyListService.findAll();
      },
    });

}