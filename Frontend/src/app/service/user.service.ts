import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {User} from "../model/user";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class UserService {
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<User[]> {
    throw new Error("Method not implemented")
  }

  public findOneById(): Observable<User> {
    throw new Error("Method not implemented")
  }
}
