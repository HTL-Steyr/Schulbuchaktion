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

        if (userService.user?.role.name=="Admin"||userService.user?.role.name=="Abteilungsvorstand") {
          this.isDisabledMoney=false
       }
       if (userService.user?.role.name=="Admin"){
         this.isDisabledClass=false
       }

     }

  logoutButtonClicked() {
    this.userService.logout();
    this.router.navigate(['/login']);
  }


}
