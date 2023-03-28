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
  private orderlistService: any;
    dataSource: DataSource<BookOrder> = new DataSource({
      key: 'id',
        load: () => {
          return this.orderlistService.findAll();
        }
    })
}
