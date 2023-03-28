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
}
