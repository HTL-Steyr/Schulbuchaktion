import { Component, ViewChild } from '@angular/core';
import { DxDataGridComponent } from 'devextreme-angular';
import dxDataGrid from 'devextreme/ui/data_grid';
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
  @ViewChild(DxDataGridComponent, { static: false }) dataGrid?: DxDataGridComponent;

  constructor(private orderlstService: OrderlistService) {
    this.dataSource = new Datasource(orderlstService);
  }

  selectionChanged(data: any) {
    this.selectedItemKeys = data.selectedRowKeys;
  }

  deleteRecords() {
    this.selectedItemKeys.forEach((key: any) => {
      this.dataSource.store().remove(key);
    });
    this.dataSource.reload().then(() => {
      this.dataGrid?.instance.refresh()
    });
    this.selectedItemKeys = [];
  }

}

