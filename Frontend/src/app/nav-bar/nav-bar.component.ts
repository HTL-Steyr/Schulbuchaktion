import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from '../service/user.service';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent {
    constructor(public userService: UserService, private router: Router) { }

    logoutButtonClicked() {
      this.userService.logout();
      this.router.navigate(['/login']);
    }

}
