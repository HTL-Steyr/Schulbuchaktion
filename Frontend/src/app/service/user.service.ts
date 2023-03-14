import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {User} from "../model/user";

@Injectable({
  providedIn: 'root'
})
export class UserService {
  constructor(private _http: HttpClient) { }

  public async getAll(): Promise<User[]> {
    throw new Error("Method not implemented")
  }

  public async getOneById(): Promise<User> {
    throw new Error("Method not implemented")
  }
}
