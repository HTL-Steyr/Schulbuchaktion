import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from '../service/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
    username: string = "";
    password: string = "";

    constructor(private router: Router, private userService: UserService) {
    }

    login() {
        if (this.username == "admin" && this.password == "admin") {
            this.userService.user = {
                id: 1,
                shortName: "admin",
                password: "admin",
                role: {
                    id: 1,
                    name: "admin",
                    users: []
                },
                token: "admin",
                firstName: "admin",
                lastName: "admin",
                email: "",
            }
            this.router.navigate(['/bestelluebersicht']);
        }
    }
}
