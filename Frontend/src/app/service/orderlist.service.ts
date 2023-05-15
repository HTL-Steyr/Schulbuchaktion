import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import { BookOrder } from '../model/bookOrder';
import { FindAll } from './findAll';
import { UserService } from './user.service';

@Injectable({
  providedIn: 'root'
})
export class OrderlistService implements FindAll<BookOrder> {
  private readonly baseUrl = 'http://schulbuch.rathgeb.at/orderlist';
  constructor(private _http: HttpClient, private userService: UserService) { }

  public findAll(): Observable<BookOrder[]> {
    return this._http.get<BookOrder[]>(this.baseUrl, {headers: this.userService.getAuthorizationHeader()});
  }

  public delete(key: any): Observable<BookOrder> {
    const id = key.id;
    return this._http.delete(this.baseUrl + "/delete" + "/" + id, {headers: this.userService.getAuthorizationHeader()});
  }
}
