import {Component} from '@angular/core';
import Swal from "sweetalert2";  //library for Alert

@Component({
  selector: 'app-root',
  templateUrl: './login-error-alert.component.html',
  styleUrls: ['./login-error-alert.component.css']
})
export class LoginErrorAlertComponent {

  title = 'Schulbuchaktion';

  constructor() {
  }

  showAlert() {
    Swal.fire({
      title: 'Error!',
      text: 'Benutzer oder Passwort falsch.',
      icon: "error",
      customClass: {
        container: 'my-alert'
      }
    });
  }

}
