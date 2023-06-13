import { Component } from '@angular/core';
import { Datasource } from '../datasources/datasource';
import { SchoolclassService } from '../service/schoolclass.service';

@Component({
  selector: 'app-classes-overview',
  templateUrl: './classes-overview.component.html',
  styleUrls: ['./classes-overview.component.css']
})
export class ClassesOverviewComponent {
  title = 'TestProjectSchulbuchaktion';
  dataSource: Datasource<SchoolclassService>;

  constructor(private subjectService: SchoolclassService) {
    this.dataSource = new Datasource(subjectService);
  }

}
