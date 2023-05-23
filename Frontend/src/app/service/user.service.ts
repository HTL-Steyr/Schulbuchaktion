import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { User } from "../model/user";
import { firstValueFrom, Observable } from "rxjs";
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private readonly localStorageKey: string = "user";
  private readonly baseUrl = 'http://schulbuch.rathgeb.at/user';

  public get user(): User | undefined {
    const localStorageValue = localStorage.getItem(this.localStorageKey);
    // @ts-ignore
    return JSON.parse(localStorageValue) ?? undefined;
  }

  public set user(value: User | undefined | null) {
    if (!value) return;
    localStorage.setItem(this.localStorageKey, JSON.stringify(value))
  }

  public get loggedIn(): boolean {
    return !!this.user;
  }

  constructor(
    private _http: HttpClient, private router: Router,
  ) { }

  public async login(email: string, password: string): Promise<User> {
    const payload = {
      email: email,
      password: password,
    }
    const loginResponse = await firstValueFrom(this._http.post<{ token: string }>(`${this.baseUrl}/login`, payload));
    const user = await firstValueFrom(this.authorizeToken(loginResponse.token));
    user.token = loginResponse.token;
    return user;
  }

  public authorizeToken(token: string): Observable<User> {
    return this._http.get<User>(
      `${this.baseUrl}/getme`,
      { headers: this.getAuthorizationHeader(token) }
    );
  }

  public getAuthorizationHeader(token: string | undefined = this.user?.token): HttpHeaders {
    const headers: HttpHeaders = new HttpHeaders();
    return headers.set("Authorization", `Bearer ${token}`)
  }

  public logout() {
    this.user = null;
    localStorage.removeItem(this.localStorageKey);
    this.router.navigate(["/login"]);
  }

  public findOneById(id: number): Observable<User> {
    // No Interface in Backend defined, but if we will need it, is already here and ready to use
    let idUrl = `${this.baseUrl}/${id}`;
    return this._http.get<User>(idUrl);
  }
}
