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

        console.log("da")

        if (userService.user?.role.id==1||userService.user?.role.id==2) {
          this.isDisabledMoney=false

          console.log("rollen id"+ userService.user.role.id +"Money disabeld sould be false"+ this.isDisabledMoney)



       }
         if (userService.user?.role.id==1){
         this.isDisabledClass=false
       }

     }

  logoutButtonClicked() {
    this.userService.logout();
    this.router.navigate(['/login']);
  }


}
