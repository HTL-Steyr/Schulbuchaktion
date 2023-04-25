import { Component } from '@angular/core';
import { UserService } from '../service/user.service';

@Component({
  selector: 'app-side-bar',
  templateUrl: './side-bar.component.html',
  styleUrls: ['./side-bar.component.css']
})
export class SideBarComponent {
  constructor(public userService: UserService) { }
}
