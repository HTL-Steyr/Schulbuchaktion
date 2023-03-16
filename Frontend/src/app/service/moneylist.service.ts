import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class MoneylistService {
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<MoneylistEntry[]> {
    throw new Error("Method not implemented")
  }
}
