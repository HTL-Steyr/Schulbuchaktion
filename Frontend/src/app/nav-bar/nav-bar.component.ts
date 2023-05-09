import { Component } from '@angular/core';
import { UserService } from '../service/user.service';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent {
    constructor(public userService: UserService) { }
}
