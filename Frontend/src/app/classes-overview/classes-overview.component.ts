import {Component, ViewChild} from '@angular/core';
import { Datasource } from '../datasources/datasource';
import { SchoolclassService } from '../service/schoolclass.service';
import {OrderlistService} from "../service/orderlist.service";
import {DxDataGridComponent} from "devextreme-angular";

@Component({
  selector: 'app-classes-overview',
  templateUrl: './classes-overview.component.html',
  styleUrls: ['./classes-overview.component.css']
})
export class ClassesOverviewComponent {
  title = 'Klassenuebersicht';
  dataSource: Datasource<SchoolclassService>;

  @ViewChild(DxDataGridComponent, { static: false }) dataGrid?: DxDataGridComponent;
  selectedItemKeys: any[] = [];

  constructor(private subjectService: SchoolclassService) {
    this.dataSource = new Datasource(subjectService);
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


}
