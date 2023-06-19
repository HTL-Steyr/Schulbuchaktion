import { Component, ViewChild } from '@angular/core';
import { DxDataGridComponent } from 'devextreme-angular';
import { Datasource } from '../datasources/datasource';
import { UserService } from '../service/user.service';

@Component({
  selector: 'app-manage-users',
  templateUrl: './manage-users.component.html',
  styleUrls: ['./manage-users.component.css']
})

export class ManageUsersComponent {

  selectedItemKeys: any[] = [];

  dataSource: Datasource<UserService>;
  @ViewChild(DxDataGridComponent, { static: false }) dataGrid?: DxDataGridComponent;

  constructor(private userService: UserService) {
    this.dataSource = new Datasource(userService)
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
