import { Component } from '@angular/core';
import { UserService } from '../service/user.service';
import {User} from "../model/user";

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent {

  private currentUser: User | undefined;
  isDisabled: boolean = true;
  constructor(public userService: UserService) {

        this.userService.findCurrentUser().subscribe((user) => {
          this.currentUser = user;
        });
        if (userService.user?.role.name=="ADMIN"||userService.user?.role.name=="AV") {
          this.isDisabled=false
        }
      }

}
