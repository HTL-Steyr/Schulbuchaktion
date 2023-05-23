import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from '../service/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
    email: string = "";
    password: string = "";

    constructor(private router: Router, private userService: UserService) {
      if (userService.loggedIn) {
        this.router.navigate(['/bestelluebersicht'])
      }
    }

    async login() {
      const user = await this.userService.login(this.email, this.password)
      if (user) {
        this.userService.user = user;
        await this.router.navigate(['/bestelluebersicht'])
      } else {
        console.error("Login failed")
      }
    }
}
