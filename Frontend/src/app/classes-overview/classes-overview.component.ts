import { Component } from '@angular/core';

@Component({
  selector: 'app-classes-overview',
  templateUrl: './classes-overview.component.html',
  styleUrls: ['./classes-overview.component.css']
})
export class ClassesOverviewComponent {
  title = 'TestProjectSchulbuchaktion';
  public items: { field: string }[] = [
    {field: '3AHITN'},
    {field: '4AHTIN'},
    {field: '5AHITN'}
  ];

  public classes = [
    { JG: '2019', Klasse: '3AHITN', 'SuS ඞ': 'Max Mustermann', HEL: 2, HME: true },
    { JG: '2020', Klasse: '3AHITN', 'SuS ඞ': 'Maria Musterfrau', HEL: 3, HME: false },
    { JG: '2019', Klasse: '4AHTIN', 'SuS ඞ': 'John Doe', HEL: 4, HME: true },
    { JG: '2020', Klasse: '4AHTIN', 'SuS ඞ': 'Jane Doe', HEL: 5, HME: false },
    { JG: '2019', Klasse: '5AHITN', 'SuS ඞ': 'Hans Huber', HEL: 6, HME: true },
    { JG: '2020', Klasse: '5AHITN', 'SuS ඞ': 'Lisa Müller', HEL: 7, HME: false },
  ];
  selectedClass: string | null = null;
  filteredClasses: any[] = [];


  selectClass(className: string) {
    this.selectedClass = className;
    this.filteredClasses = this.classes.filter((item) => item.Klasse == className);

  }
}
