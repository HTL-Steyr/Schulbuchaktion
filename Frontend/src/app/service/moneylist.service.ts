import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {MoneylistEntry} from "../model/moneylistEntry";
import { FindAll } from './findAll';
import { UserService } from './user.service';

@Injectable({
  providedIn: 'root'
})
export class MoneylistService implements FindAll<MoneylistEntry>{
  private readonly baseUrl = 'http://schulbuch.rathgeb.at/moneylist';
  constructor(private _http: HttpClient, private userService: UserService) { }

  update(id: number, data: MoneylistEntry): Observable<MoneylistEntry> {
    return this._http.put<MoneylistEntry>(`${this.baseUrl}/update/${id}`, data, {headers: this.userService.getAuthorizationHeader()});
  }

  public delete(id: number): Observable<MoneylistEntry> {
    throw new Error('Method not implemented.');
  }

  public findAll(): Observable<MoneylistEntry[]> {
    return this._http.get<MoneylistEntry[]>(this.baseUrl, {headers: this.userService.getAuthorizationHeader()});
  }
}
