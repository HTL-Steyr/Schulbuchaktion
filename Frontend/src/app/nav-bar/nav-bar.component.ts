import { Component } from '@angular/core';
import { UserService } from '../service/user.service';
import {User} from "../model/user";
import {Router} from "@angular/router";

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent {

  private currentUser: User | undefined;
  isDisabledMoney: boolean = true;
  isDisabledClass: boolean = true;
  constructor(public userService: UserService, private router:Router) {

        if (userService.user?.role.id==1||userService.user?.role.id==2) {
          this.isDisabledMoney=false
       }
         if (userService.user?.role.id==1){
         this.isDisabledClass=false
       }

     }

  logoutButtonClicked() {
    this.userService.ausloggen();
    this.router.navigate(['/login']);
  }


}
