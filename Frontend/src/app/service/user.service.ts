import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {User} from "../model/user";
import {firstValueFrom, Observable} from "rxjs";

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

  constructor(
    private _http: HttpClient,
  ) { }

  public async login(email: string, password: string): Promise<User> {
    const payload = {
      email: email,
      password: password,
    }
    const loginResponse = await firstValueFrom(this._http.post<{token: string}>(`${this.baseUrl}/login`, payload));
    const user = await firstValueFrom(this._http.get<User>(
      `${this.baseUrl}/getme`,
      {headers: this.getAuthorizationHeader(loginResponse.token)}
    ));
    user.token = loginResponse.token;
    return user;
  }

  public getAuthorizationHeader(token: string | undefined = this.user?.token): HttpHeaders {
    const headers: HttpHeaders = new HttpHeaders();
    return headers.set("Authorization", `Bearer ${token}`)
  }

  public logout() {
    this.user = null;
    localStorage.removeItem(this.localStorageKey);
  }

  public findOneById(id: number): Observable<User> {
    // No Interface in Backend defined, but if we will need it, is already here and ready to use
    let idUrl = `${this.baseUrl}/${id}`;
    return this._http.get<User>(idUrl);
  }
}
