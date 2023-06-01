import { Component } from '@angular/core';
import { Datasource } from '../datasources/datasource';
import { OrderlistService } from '../service/orderlist.service';
import { SubjectService } from '../service/subject.service';


@Component({
  selector: 'app-orderlist',
  templateUrl: './orderlist.component.html',
  styleUrls: ['./orderlist.component.css']
})
export class OrderlistComponent {

  selectedItemKeys: any[] = [];

  dataSource: Datasource<OrderlistService>;

  constructor(private orderlstService: OrderlistService) {
    this.dataSource = new Datasource(orderlstService);
  }

  selectionChanged(data: any) {
    this.selectedItemKeys = data.selectedRowKeys;
  }

  loescheEintrag() {
    this.selectedItemKeys.forEach((key: any) => {
      this.dataSource.store().remove(key);
    });
    this.dataSource.reload();
    this.selectedItemKeys = [];
  }

}

