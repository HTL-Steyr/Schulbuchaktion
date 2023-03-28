import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import { BookOrder } from '../model/bookOrder';

@Injectable({
  providedIn: 'root'
})
export class OrderlistService {
  private readonly baseUrl = '../orderlist';
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<BookOrder[]> {
    return this._http.get<BookOrder[]>(this.baseUrl);
  }
}
