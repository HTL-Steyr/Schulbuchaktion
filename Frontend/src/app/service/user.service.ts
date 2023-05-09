import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { User } from "../model/user";
import { Observable } from "rxjs";

@Injectable({
    providedIn: 'root'
})
export class UserService {
  logout() {
    this.user = undefined;
  }
    private _user?: User;
  private readonly baseUrl = '../user';

    public get user(): User | undefined {
        return this._user;
    }

    public set user(value: User | undefined) {
        if (!value) return;

        this._user = value;
    }

    constructor(private _http: HttpClient) { }

  public findCurrentUser(): Observable<User> {
    let getCurrentUserUrl = `${this.baseUrl}/getme`;
    return this._http.get<User>(getCurrentUserUrl);
  }

  public findOneById(id: number): Observable<User> {
    // No Interface in Backend defined, but if we will need it, is already here and ready to use
    let idUrl = `${this.baseUrl}/${id}`;
    return this._http.get<User>(idUrl);
  }
}
