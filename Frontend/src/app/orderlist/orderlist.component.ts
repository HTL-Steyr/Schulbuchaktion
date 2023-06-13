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
    this.cloneIconClick = this.cloneIconClick.bind(this);
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

  clearSorting() {
    this.dataGrid?.instance.clearSorting();
  }

  isCloneIconVisible(e: any) {
    return !e.row.isEditing;
  }

  cloneIconClick(e: any) {
    const clonedItem = Object.assign({}, e.row.data);

    // need insert route for this operation, will work if implemented
    e.component.getDataSource().store().insert(clonedItem);

    e.component.getDataSource().reload();

    e.component.refresh(true);
    e.event.preventDefault();
  }

}

