import {Component} from '@angular/core';
import {UserService} from '../service/user.service';
import {User} from "../model/user";
import {Router} from "@angular/router";


@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent {

  private currentUser: User | undefined;
  isDisabledMoney: boolean = true
  isDisabledClass: boolean = true
  isDisabledImports: boolean = true

  // <a routerLink="/import" *ngIf="isDisabledClass">Import</a>
  constructor(public userService: UserService, private router: Router) {

console.log("construct")
    if (userService.user?.role.id == 1 || userService.user?.role.id == 2) {

      this.isDisabledMoney = false
      this.isDisabledImports = false
      this.isDisabledClass = false


    } else if (userService.user?.role.id == 3) {
      this.isDisabledClass = true
      this.isDisabledImports = true;
      this.isDisabledMoney = true

    } else if (userService.user?.role.id == 4) {
      this.isDisabledClass = true
      this.isDisabledImports = true;
      this.isDisabledMoney = true
    }
  }

  configureRights(userService: UserService, router: Router) {

  }


  logoutButtonClicked() {
    this.userService.logout();
    this.router.navigate(['/login']);
  }


}
