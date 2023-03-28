import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {MoneylistEntry} from "../model/moneylistEntry";

@Injectable({
  providedIn: 'root'
})
export class MoneylistService {
  private readonly baseUrl = '../moneylist';
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<MoneylistEntry[]> {
    return this._http.get<MoneylistEntry[]>(this.baseUrl);
  }
}
