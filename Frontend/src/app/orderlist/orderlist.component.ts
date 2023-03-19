import { Component } from '@angular/core';
import DataSource from 'devextreme/data/data_source';
import { OrderlistEntry } from '../model/orderlistEntry';


@Component({
  selector: 'app-orderlist',
  templateUrl: './orderlist.component.html',
  styleUrls: ['./orderlist.component.css']
})
export class OrderlistComponent {
    dataSource: DataSource<OrderlistEntry> = new DataSource([{
        id: 1,
    }]);
}
