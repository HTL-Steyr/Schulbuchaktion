import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import { OrderlistEntry } from '../model/orderlistEntry';

@Injectable({
  providedIn: 'root'
})
export class OrderlistService {
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<OrderlistEntry[]> {
    throw new Error("Method not implemented")
  }
}
