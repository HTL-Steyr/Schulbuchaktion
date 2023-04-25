import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import { BookOrder } from '../model/bookOrder';
import { FindAll } from './findAll';

@Injectable({
  providedIn: 'root'
})
export class OrderlistService implements FindAll<BookOrder> {
  private readonly baseUrl = '../orderlist';
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<BookOrder[]> {
    return this._http.get<BookOrder[]>(this.baseUrl);
  }
}
