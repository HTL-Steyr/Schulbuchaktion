import {Component} from '@angular/core';
import {UserService} from '../service/user.service';
import {User} from "../model/user";
import {Router} from "@angular/router";
import {Pipe, PipeTransform} from '@angular/core';

@Pipe({name: 'showMenuItem',})


export class ShowMenuItemPipe implements PipeTransform {
  transform(menuItemName: string, role: string): boolean {
    if (menuItemName === 'Import') {
      return role === '1';
    } else if (menuItemName === 'Bestelluebersicht') {
      return role === '1' || role === '2' || role === '3' || role === '4';
    } else if (menuItemName === 'Klassenuebersicht') {
      return role === '1';
    } else if (menuItemName === 'Gelduebersicht') {
      return role === '1' || role === '2';
    } else if (menuItemName === 'Users') {
      return role === '1';
    }
    return true;
  }
}
@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']

})
export class NavBarComponent {
  /*
  private currentUser: User | undefined;
  isDisabledMoney: boolean = true
  isDisabledClass: boolean = true
  isDisabledImports: boolean = true
   */
  constructor(public userService: UserService, private router: Router) {

  }
  navItems = [
    {
      name: 'Bestelluebersicht',
      path: '/bestelluebersicht',
      text: 'Bestelluebersicht',
      icon: '',
      role: '3'
    },
    {
      name: 'Klassenuebersicht',
      path: '/klassenuebersicht',
      text: 'Klassenuebersicht',
      icon: '',
      role: '4'
    },
    {
      name: 'Gelduebersicht',
      path: '/gelduebersicht',
      text: 'Gelduebersicht',
      icon: '',
      role: '4'
    },
    {
      name: 'Users',
      path: '/manageusers',
      text: 'Users',
      icon: '',
      role: '1'
    },
    {
      name: 'Import',
      path: '/import',
      text: 'Import',
      icon: '',
      role: '4'
    },
  ];
  logoutButtonClicked() {
    this.userService.logout();
    this.router.navigate(['/login']);
  }


}
