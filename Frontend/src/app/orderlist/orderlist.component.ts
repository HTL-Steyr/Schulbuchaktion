import { Component } from '@angular/core';
import DataSource from 'devextreme/data/data_source';
import { Datasource } from '../datasources/datasource';
import { BookOrder } from '../model/bookOrder';
import { OrderlistService } from '../service/orderlist.service';


@Component({
  selector: 'app-orderlist',
  templateUrl: './orderlist.component.html',
  styleUrls: ['./orderlist.component.css']
})
export class OrderlistComponent{
  dataSource: Datasource<OrderlistService>;

  selectedItemKeys:any[] = [];

  selectionChanged(data: any) {
    this.selectedItemKeys = data.selectedRowKeys;
    console.log(this.selectedItemKeys);
  }

  deleteRecords() {
    this.selectedItemKeys.forEach((key: any) => {
      this.dataSource.store().remove(key.id);
    });
    this.dataSource.reload();
    this.selectedItemKeys = [];
  }

  constructor(private service: OrderlistService) {
    this.dataSource = new Datasource(service);
  }
}

