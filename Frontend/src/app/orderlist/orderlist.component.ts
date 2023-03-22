import { Component } from '@angular/core';
import DataSource from 'devextreme/data/data_source';
import { BookOrder } from '../model/bookOrder';


@Component({
  selector: 'app-orderlist',
  templateUrl: './orderlist.component.html',
  styleUrls: ['./orderlist.component.css']
})
export class OrderlistComponent {
    dataSource: DataSource<BookOrder> = new DataSource([{
        id: 1,
    }]);
}
