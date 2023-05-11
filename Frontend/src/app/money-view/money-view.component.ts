import {Component, NgModule, OnInit} from '@angular/core';
import {Observable} from "rxjs";
import {MoneylistEntry} from "../model/moneylistEntry";
import DevExpress from "devextreme";
import CustomStore = DevExpress.data.CustomStore;
import { Datasource } from '../datasources/datasource';
import { MoneylistService } from '../service/moneylist.service';

@Component({
  selector: 'app-money-view',
  templateUrl: './money-view.component.html',
  styleUrls: ['./money-view.component.css']
})

export class MoneyViewComponent {
  public dataSource: Datasource<MoneylistService>;
  constructor(moneylistService: MoneylistService) {
    this.dataSource = new Datasource<MoneylistService>(moneylistService);
  }
}
