import { Component } from '@angular/core';
import { NavigationStart, Router } from '@angular/router';
import { UserService } from './service/user.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'SchoolBookOrderSystem';

  constructor(private router: Router, public userService: UserService) {
    router.events.subscribe((val) => {
      if (!(val instanceof NavigationStart)) return;

      if (!this.userService.user && val.url != '/login') {
        this.router.navigate(['login']);
      } else {
        console.log("User is logged in");
        console.log(userService.user);


        if (userService.user?.token) {
          console.log('sameg');

          userService.authorizeToken(userService.user.token).subscribe(user => {
            console.log("Ihna is logged in");

            if (userService.user?.token) {
              user.token = userService.user?.token;
              userService.user = user;
            }
          }, _ => {
            userService.logout();
            router.navigate(['login']);
          });
        }
      }
    }
    );
  }
}
