import { Component } from '@angular/core';
import DataSource from 'devextreme/data/data_source';
import { BookOrder } from '../model/bookOrder';
import { OrderlistService } from '../service/orderlist.service';


@Component({
  selector: 'app-orderlist',
  templateUrl: './orderlist.component.html',
  styleUrls: ['./orderlist.component.css']
})

export class OrderlistComponent{
public dataSource: DataSource<OrderlistService>;
constructor(orderlistService: OrderlistService) {
  this.dataSource = new DataSource<OrderlistService>(orderlistService)
  }
}

